<?php

namespace App\Http\Controllers\Customer;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    function customerhome(){
        $categories=Category::get();
        if(request('sorting')){
            explode(",",request('sorting'));

        }

        $products=Product::select('products.id','products.name','products.price','products.description','products.image','categories.name as category_name',)
        ->leftJoin('categories','products.category_id','categories.id')
        ->when(request('categoryid'),function($query){//search category
            $query->where('products.category_id',request('categoryid'));
        })->when(request('key'),function($query){//search by name
            $query->where('products.name','like','%'.request('key').'%');
        })
        ->when(request('sorting'),function($query){//sort by
           $sortrule= explode(",",request('sorting'));
           $sortname='products.'.$sortrule[0];//products.price,products.name,products.created_at
           $sortby=$sortrule[1];//asc.desc
            $query=$query->orderBy($sortname,$sortby );
        })
        //min=true max=true
        ->when(request('minprice')!=null && request('maxprice')!=null, function($query) {
            $query=$query->whereBetween('products.price',[request('minprice'),request('maxprice')]);
        })
        ->when(request('minprice')!=null && request('maxprice')==null, function($query) {//min=true max =false
            $query=$query->where('products.price','>=',request('minprice'));
        })->when(request('minprice')==null && request('maxprice')!=null, function($query) {//min=false max =true
            $query=$query->where('products.price','<=',request('maxprice'));
        })
        ->paginate(8);
        return view('customer.home.list',compact('products','categories'));
    }
    function customerinfo(){
        return view('customer.profile.accountinfo');
    }
    function updateinfo($id){

        $userinfo=User::where('id',$id)->get();
        return view('customer.profile.edit',compact('userinfo'));



    }
    private function checkuser($req){
        $req->validate([

        ]);

    }
}
