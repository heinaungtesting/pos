<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class routecontroller extends Controller
{
    //product list
    function productlist(){
        $list=Product::get();
        return response()->json($list, 200);

    }
    function delete(Request $req){

    }
}
