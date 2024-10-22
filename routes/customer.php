<?php
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\customer\Productcontrollers;
use App\Http\Controllers\Customer\CustomerController;


Route::group(['prefix'=>'customer','middleware'=>'user'],function(){
    Route::get('home/{id?}',[CustomerController::class,'customerhome'])->name('customerhome');
    Route::get('product/detail/{id}',[Productcontrollers::class,'detail'])->name('productdetail');
    Route::post('addtocart',[Productcontrollers::class,'addtocart'])->name('addtocart');
    Route::get('cart',[Productcontrollers::class,'cart'])->name('cart');
    Route::get('cart/delete',[Productcontrollers::class,'cartdelete'])->name('cartdelete');
    Route::get('product/list',[Productcontrollers::class,'productlist'])->name('productlist');
    Route::get('cart/temp',[Productcontrollers::class,'carttemp'])->name('carttemp');
    Route::get('payment',[Productcontrollers::class,'paymentuser'])->name('paymentuser');
    Route::post('order',[Productcontrollers::class,'order'])->name('productorder');






    Route::group(['prefix'=>'profile'],function(){
        Route::get('customerinfo',[CustomerController::class,'customerinfo'])->name('customerinfo');
        Route::get('updatepassword/{id}',[CustomerController::class,'upatepasswordpage'])->name('updateuserpassword');
        Route::post('updatepassword/{id}',[CustomerController::class,'edit'])->name('edituserpassword');
        Route::get('updateinfo/{id}',[CustomerController::class,'upateinfo'])->name('updateuserinfo');
        Route::post('updateinfo/{id}',[CustomerController::class,'editinfo'])->name('edituserinfo');

    });
});
