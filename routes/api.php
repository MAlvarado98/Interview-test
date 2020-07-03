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

Route::prefix('/products')->group(function () {
    Route::get('/','ProductController@getAll');
    Route::get('/{category}','ProductController@index');
    Route::get('/{id}/{productSlug}','ProductController@show');
    Route::middleware('auth:api')->post('/','ProductController@store');
    Route::middleware('auth:api')->put('/{id}','ProductController@update');
    Route::middleware('auth:api')->delete('/{id}','ProductController@destroy');
});

Route::prefix('/users')->group(function () {
    Route::post('/login','AuthController@login');
    Route::post('/register','AuthController@register');
    Route::middleware('auth:api')->get('/','UserController@index');
    Route::middleware('auth:api')->post('/','UserController@store');
    Route::middleware('auth:api')->get('/user/{id}','UserController@show');
    Route::middleware('auth:api')->get('/current','UserController@getCurrentUser');
    Route::middleware('auth:api')->put('/user/{id}','UserController@update');
    Route::middleware('auth:api')->delete('/user/{id}','UserController@destroy');
});

Route::prefix('/cart')-> group(function () {
    Route::middleware('auth:api')->get('/','CartController@index');
    Route::middleware('auth:api')->post('/','CartController@store');
    Route::middleware('auth:api')->put('/{id}','CartController@update');
    Route::middleware('auth:api')->delete('/{id}','CartController@destroy');
    Route::middleware('auth:api')->delete('/all','CartController@destroyAll');
});
