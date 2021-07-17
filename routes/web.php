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



//GUEST (UI) ROUTES
    Route::name('guest.')
        ->group(
            function() {

            //LANDING ROUTES
            Route::get('/', function(){
                return view('welcome');
            });

            //QUESTA IN REALTA' E' LA HOME DELLA DASHBOARD,VA CAMBIATA
            Route::get('/home', 'HomeController@index')->name('home');

        }
    );
        
//BRAINTREE ROUTES
Route::get('/pay/{order:id}','PaymentController@setupPayment' )->name('guest.setupPayment');
Route::post('/checkout/{order:id}','PaymentController@checkout' )->name('guest.checkout');


//Order Routes 
Route::name('guest.')
    ->group(function(){
        Route::get('/restaurants/{user:slug}/create','OrderController@create')->name('orders.create');
        Route::post('/restaurants/{user:slug}/store','OrderController@store')->name('orders.store');
    });



/*****************************
*  AUTH DASHBOARD ROUTES
******************************/
Auth::routes();

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