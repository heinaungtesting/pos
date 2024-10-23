<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\PaymentHistory;

class OrderController extends Controller
{
    //direct order list
    function list(){
        $order=Order::select('orders.id','orders.status','orders.order_code','orders.created_at','users.name as user_name')
        ->leftJoin('users','orders.user_id','users.id')
        ->when(request('key'),function ($query){
            $query->whereAny(['orders.order_code','users.name'],'like','%'.request('key').'%');
        })
        ->orderBy('orders.created_at','desc')->
        groupBy('orders.order_code')
        
        ->
        get();
        return view('admin.order.list',compact('order'));
    }
    function detail($ordercode){
        $order=Order::select('orders.count as order_count','orders.order_code as order_code','orders.created_at as created_at','products.name as product_name',
        'products.price as product_price','products.image as product_image','products.id as product_id','products.stock as stock','users.name as user_name',
        'users.nickname as user_nickname','users.phone as user_phone','users.email','users.address as user_add',)  //'orders.', 'products.',  'users.',
        ->leftJoin('products','orders.product_id','products.id')
        ->leftJoin('users','orders.user_id','users.id')


        ->where('order_code',$ordercode)

        ->get();
        $paydata=PaymentHistory::where('order_code',$ordercode)->first();
        $confirm=[];
        $status=true;
        foreach($order as $item){
            array_push($confirm,$item->stock < $item->order_count ? false : true);
        }
        foreach($confirm as $item){
            if($item==false){
                $status=false ; break ;

            }
        }
      //false ->out of stock true-> has stock
        return view('admin.order.detail',compact('order','paydata','status'));
    }
    //change status
    function changestatus(Request $req){
        Order::where('order_code',$req['order_code'])->update([
            'status'=>$req['status']
        ]);
        return response()->json(['status'=>'success'],200);
    }
    function confirm(Request $req){

        Order::where('order_code',$req[0]['order_code'])->update([
'status'=>1
        ]);

    foreach($req->all() as $item){
        Product::where('id',$item['product_id'])->decrement('stock',$item['order_count']);

    }
    return response()->json(['status'=>'success'],200);
    }
    function reject(Request $req){
        Order::where('order_code',$req->order_code)->update([
            'status'=>2
        ]);
        return response()->json(['status'=>'success'],200);

    }
}
