<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use Braintree\Gateway as Gateway;
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

//Categories API
Route::get('/categories','Api\CategoryController@index');
Route::get('/categories/{category:slug}','Api\CategoryController@show');

//Restaurant API
Route::get('/restaurants','Api\RestaurantController@index');
Route::get('/restaurants/search/{queryString}','Api\RestaurantController@search');
Route::get('/restaurants/{user:slug}','Api\RestaurantController@show');





