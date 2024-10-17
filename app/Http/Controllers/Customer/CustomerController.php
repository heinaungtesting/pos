<?php

namespace App\Http\Controllers\Customer;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    function customerhome($categoryid=null){
        $categories=Category::get();
        $products=Product::select('products.id','products.name','products.price','products.description','products.image','categories.name as category_name',)
        ->leftJoin('categories','products.category_id','categories.id')
        ->when($categoryid!=null,function($query)use($categoryid){
            $query->where('products.category_id',$categoryid);
        })
        ->orderBy('products.created_at','desc')->get();
        return view('customer.home.list',compact('products','categories'));
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
