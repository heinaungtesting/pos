<?php
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\ContactController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\customer\Productcontrollers;


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
    Route::get('orderlist',[Productcontrollers::class,'orderlist'])->name('productorderlist');
    Route::post('comment',[Productcontrollers::class,'comment'])->name('productcomment');
    Route::get('comment/delete/{id}',[Productcontrollers::class,'deletecomment'])->name('deletecomment');
    Route::post('rating',[Productcontrollers::class,'rating'])->name('productrating');
    Route::get('contact',[ContactController::class,'contact'])->name('contact');
    Route::post('contactsent',[ContactController::class,'contactsent'])->name('contactsent');











    Route::group(['prefix'=>'profile'],function(){
        Route::get('customerinfo',[CustomerController::class,'customerinfo'])->name('customerinfo');
        Route::get('updatepassword',[CustomerController::class,'updateuserpassword'])->name('updateuserpassword');
        Route::post('updatepassword/{id}',[CustomerController::class,'edit'])->name('edituserpassword');
        Route::get('updateinfo/{id}',[CustomerController::class,'updateinfo'])->name('updateuserinfo');
        Route::post('updateinfo',[CustomerController::class,'editinfo'])->name('edituserinfo');

    });
});
