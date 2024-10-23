<?php

namespace App\Http\Controllers\customer;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Rating;
use App\Models\Comment;
use App\Models\Payment;
use App\Models\Product;
use App\Models\ActionLog;
use Illuminate\Http\Request;
use App\Models\PaymentHistory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Productcontrollers extends Controller
{
    function detail($id)
    {
        $product = Product::select('products.id', 'products.stock as stock', 'products.name', 'products.price', 'products.description', 'products.image', 'categories.name as category_name',)
            ->leftJoin('categories', 'products.category_id', 'categories.id')
            ->where('products.id', $id)
            ->first();
        $productlist = Product::select('products.id', 'products.name', 'products.price', 'products.description', 'products.image', 'categories.name as category_name',)
            ->leftJoin('categories', 'products.category_id', 'categories.id')
            ->where('categories.name', $product['category_name'])
            ->where('products.id', '!=', $product['id'])
            ->get();
        $comment = Comment::select('comments.*', 'users.name as user_name', 'users.profile as user_profile')->where('product_id', $id)
            ->leftJoin('users', 'comments.user_id', 'users.id')
            ->orderBy('comments.created_at', 'desc')->get();
            $rating=Rating::where('product_id',$id)->avg('count');
            $user_rating=Rating::where('product_id',$id)->where('user_id',Auth::user()->id)->first('count');
            $user_rating=$user_rating==null ? 0 : $user_rating['count'];
            //Action log
          $this->actionlog(Auth::user()->id,$id,'seen');
          //view count
          $view=ActionLog::where('post_id',$id)->where('action','seen')->get();
          $view=count($view);


        return view('customer.home.detail', compact('product', 'productlist', 'comment','rating','user_rating','view'));
    }
    function addtocart(Request $req)
    {
        Cart::create([
            'user_id' => $req->userid,
            'product_id' => $req->productid,
            'qty' => $req->count
        ]);
        $this->actionlog($req->userid, $req->productid,'addtocard');
        return to_route('customerhome');
    }
    function cart()
    {
        $cart = Cart::select('products.image', 'products.name', 'products.price', 'carts.qty', 'products.id as product_id', 'carts.id as cart_id')
            ->leftJoin('products', 'product_id', 'products.id')
            ->where('carts.user_id', Auth::user()->id)->get();
        $total = 0;
        foreach ($cart as $item) {
            $total += $item->price * $item->qty;
        }
        return view('customer.home.cart', compact('cart', 'total'));
    }
    function cartdelete(Request $req)
    {
        $cartid = $req->cartid;
        Cart::where('id', $cartid)->delete();
        return response()->json([
            'status' => 'success'
        ]);
    }
    function productlist()
    {
        $product = Product::get();
        return response()->json([
            'data' => $product,
            'status' => 'success'
        ], 200);
    }

    function carttemp(Request $req)
    {
        $orderarr = [];
        foreach ($req->all() as $item) {
            array_push($orderarr, [
                'user_id' => $item['user_id'],
                'product_id' => $item['product_id'],
                'count' => $item['qty'],
                'total' => $item['total_amount'],
                'status' => 0,
                'order_code' => $item['ordercode'],

            ]);
        }

        Session::put('tempCart', $orderarr);
        return response()->json([
            'status' => 'success'
        ], 200);
    }
    function paymentuser()
    {
        $payment = Payment::orderBy('created_at', 'desc')->get();
        $orderproduct = Session::get('tempCart');
        return view('customer.home.payment', compact('payment', 'orderproduct'));
    }
    function order(Request $req)
    {
        $req->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'paymenttype' => 'required',
            'payslipimage' => 'required',

        ]);
        //store paysliphistory

        $paymentHistoryData = [
            'user_name' => $req->name,
            'phone' => $req->phone,
            'address' => $req->address,
            'payment_method' => $req->paymenttype,
            'order_code' => $req->ordercode,
            'total_amt' => $req->total,

        ];
        if ($req->hasFile('payslipimage')) {
            $filename = uniqid() . $req->file('payslipimage')->getClientOriginalName();
            $req->file('payslipimage')->move(public_path() . '/payslip', $filename);
            $paymentHistoryData['payslip_image'] = $filename;
        }
        PaymentHistory::create($paymentHistoryData);
        //order and clear cart
        $order = Session::get('tempCart');

        foreach ($order as $item) {
            Order::create([
                'user_id' => $item['user_id'],
                'product_id' => $item['product_id'],
                'count' => $item['count'],
                'status' => $item['status'], // 0-> pending, 1-> confirm,  2-> reject
                'order_code' => $item['order_code'],
            ]);
            Cart::where('user_id', $item['user_id'])->where('product_id', $item['product_id'])->delete();
            return to_route('productorderlist');
        }
    }
    function orderlist()
    {
        $order = Order::where('user_id', Auth::user()->id)
            ->groupBy('order_code')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('customer.home.order', compact('order'));
    }
    function comment(Request $req)
    {
        Comment::create([
            'product_id' => $req->productid,
            'user_id' => Auth::user()->id,
            'message' => $req->comment

        ]);
        $this->actionlog($req->userid, $req->productid,'comment');

        return back();
    }
    function deletecomment($id){
        Comment::where('id',$id)->delete();
        return back();

    }
    function rating(Request $req)
    {
       Rating::updateOrCreate(['user_id' => Auth::user()->id,'product_id' => $req->productid,], [

            'count' => $req->productrating
        ]);
        $this->actionlog(Auth::user()->id, $req->productid,'rating');

        return back();
    }
    private function actionlog($user_id,$product_id,$action){
        ActionLog::create([
            'user_id'=>$user_id,
            'post_id'=>$product_id,
            'action'=>$action
           ]);
    }
}
