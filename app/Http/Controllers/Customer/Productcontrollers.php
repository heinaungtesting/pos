<?php

namespace App\Http\Controllers\customer;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Productcontrollers extends Controller
{
    function detail($id){
        $product=Product::select('products.id','products.name','products.price','products.description','products.image','categories.name as category_name',)
        ->leftJoin('categories','products.category_id','categories.id')
        ->first();
        return view('customer.home.detail',compact('product'));
    }
}
