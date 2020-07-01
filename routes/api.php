<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('products', 'ProductController');

Route::prefix('/users')->group(function () {
    Route::post('/login','AuthController@login');
    Route::middleware('auth:api')->get('/','UserController@index');
    Route::middleware('auth:api')->get('/current','UserController@getCurrentUser');
});
Route::resource('cart', 'CartController');
