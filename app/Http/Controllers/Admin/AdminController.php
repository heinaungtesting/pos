<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\PaymentHistory;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    function adminhome(){
        $total_sale=number_format(PaymentHistory::sum('total_amt'));
        $totalorder=number_format(Order::where('status',1)->count('status'));
        $user_count=number_format(User::where('role','user')->count('id'));
        return view('admin.home.list',compact('total_sale','totalorder','user_count'));
    }
}
