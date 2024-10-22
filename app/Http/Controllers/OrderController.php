<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //direct order list
    function list(){
        $order=Order::select('orders.id','orders.status','orders.order_code','orders.created_at','users.name as user_name')
        ->leftJoin('users','orders.user_id','users.id')
        ->orderBy('orders.created_at','desc')->
        groupBy('orders.order_code')->
        get();
        return view('admin.order.list',compact('order'));
    }
}
