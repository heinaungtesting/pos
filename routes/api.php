<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\routecontroller;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('product/list',[routecontroller::class,'productlist']);
Route::post('delete',[routecontroller::class,'delete']);
