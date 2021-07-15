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


Auth::routes();


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
        Route::get('/checkout/{order:id}',function($order){
            return redirect()->route('guest.setupPayment',['order'=>$order]);
        });


    //AUTH (UR) ROUTES
        Route::prefix('admin')
            ->namespace('Admin')
            ->middleware('auth')
            ->name('admin.')
            ->group(function () {
                Route::resource('foods', 'FoodController');
                Route::get('/orders','OrderController@index');
            }
        );