<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/*****************************
*     PUBLIC ROUTES
******************************/

Route::get('/', function(){
    return view('welcome');
});


Route::get('/home', 'HomeController@index')->name('home');

//Order Routes [temporary]
Route::name('guest.')
        ->group(function(){
            Route::get('/restaurants/{user:slug}/create','OrderController@create')->name('orders.create');
            Route::post('/restaurants/{user:slug}/store','OrderController@store')->name('orders.store');
        });

Auth::routes();

/*****************************
*  AUTH DASHBOARD ROUTES
******************************/
Route::prefix('admin')
    ->namespace('Admin')
    ->middleware('auth')
    ->name('admin.')
    ->group(function () {
                //Foods Routes
                Route::resource('foods', 'FoodController');
                
                //Order Routes
                Route::get('/orders','OrderController@index');
    }
);
