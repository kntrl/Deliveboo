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
//GUEST (UI) ROUTES
Route::name('guest.')
->group(
    function() {

    //LANDING ROUTES
    Route::get('/', function(){
        return view('welcome');
    })->name('welcome');


    //Order Routes => used for testing only. REMOVE BEFORE PRODUCTION
    Route::get('/restaurants/{user:slug}/create','OrderController@create')->name('orders.create');
    Route::post('/restaurants/{user:slug}/store','OrderController@store')->name('orders.store');

}
);

//AUTH ROUTES
Auth::routes(['verify' => true]);
Auth::routes();

//BRAINTREE ROUTES
Route::get('/pay/{order:id}','PaymentController@setupPayment' )->name('guest.setupPayment');
Route::post('/checkout/{order:id}','PaymentController@checkout' )->name('guest.checkout');



//QUESTA IN REALTA' E' LA HOME DELLA DASHBOARD,VA CAMBIATA
Route::get('/dashboard', 'HomeController@index')->name('admin.home')/*->middleware('verified')*/;

/*****************************
*  AUTH DASHBOARD ROUTES
******************************/
Route::prefix('dashboard')
->namespace('Admin')
->middleware('auth')
/*->middleware('verified')*/
->name('admin.')
->group(function () {

        //Foods Routes
        Route::resource('foods', 'FoodController');
        
        //Order Routes
        Route::get('/orders','OrderController@index')->name('orders.index');
        Route::put('/orders','OrderController@markAsComplete')->name('orders.complete');
        Route::get('/orders/stats','OrderController@stats')->name('orders.stats');
    }
);