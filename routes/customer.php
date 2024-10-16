<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\CustomerController;
Route::group(['prefix'=>'customer','middleware'=>'user'],function(){
    Route::get('home',[CustomerController::class,'customerhome'])->name('customerhome');

    Route::group(['prefix'=>'profile'],function(){
        Route::get('customerinfo',[CustomerController::class,'customerinfo'])->name('customerinfo');
        Route::get('updatepassword/{id}',[CustomerController::class,'upatepasswordpage'])->name('updateuserpassword');
        Route::post('updatepassword/{id}',[CustomerController::class,'edit'])->name('edituserpassword');
        Route::get('updateinfo/{id}',[CustomerController::class,'upateinfo'])->name('updateuserinfo');
        Route::post('updateinfo/{id}',[CustomerController::class,'editinfo'])->name('edituserinfo');

    });
});
