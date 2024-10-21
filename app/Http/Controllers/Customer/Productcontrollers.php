<?php

namespace App\Http\Controllers\customer;

use App\Models\Cart;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Productcontrollers extends Controller
{
    function detail($id){
        $product=Product::select('products.id','products.name','products.price','products.description','products.image','categories.name as category_name',)
        ->leftJoin('categories','products.category_id','categories.id')
        ->where('products.id',$id)
        ->first();
        $productlist=Product::select('products.id','products.name','products.price','products.description','products.image','categories.name as category_name',)
        ->leftJoin('categories','products.category_id','categories.id')
        ->where('categories.name',$product['category_name'])
        ->where('products.id','!=',$product['id'])
        ->get();
        return view('customer.home.detail',compact('product','productlist'));

    }
    function addtocart(Request $req){
        Cart::create([
            'user_id'=>$req->userid,
            'product_id'=>$req->productid,
            'qty'=>$req->count
        ]);
        return to_route('customerhome');

    }
    function cart(){
        $cart=Cart::select('products.image','products.name','products.price','carts.qty','products.id as product_id','carts.id as cart_id')
        ->leftJoin('products','product_id','products.id')
        ->where('carts.user_id',Auth::user()->id)->get();
        $total=0;
        foreach($cart as $item)
    {
        $total+=$item->price * $item->qty;
    }
        return view('customer.home.cart',compact('cart','total'));
    }
    function cartdelete(Request $req){
       $cartid=$req->cartid;
       Cart::where('id',$cartid)->delete();
       return response()->json([
        'status'=>'success'
       ]);

    }
    function productlist(){
    $product =Product::get();
    return response()->json([
        'data'=>$product,
        'status'=>'success'
    ],200);
    }

    function carttemp(Request $req){
        $orderarr=[];
        foreach($req->all() as $item){
array_push($orderarr,[
    'user_id'=>$item['user_id'],
    'product_id'=>$item['product_id'],
    'count'=>$item['qty'],
    'status'=>0,
    'order_code'=>$item['ordercode'],

]);

        }

        Session::put('tempCart',$orderarr);
       return response()->json([
       'status'=>'success'
       ],200);
    }
    function payment(){
        $payment=Payment::orderBy('created_at','desc')->get();
        return view('customer.home.payment',compact('payment'));
    }


}
