<?php

namespace App\Http\Controllers\Customer;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    function customerhome(){
        return view('customer.home.list');
    }
    function customerinfo(){
        return view('customer.profile.accountinfo');
    }
    function updateuserinfo($id){

        $userinfo=User::where('id',$id)->get();
        return view('customer.profile.edit',compact('userinfo'));



    }
    private function checkuser($req){
        $req->validate([

        ]);

    }
}
