<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'HomeController@showWelcome');

Route::resource('api/products', 'APIProductController');
Route::post('api/login', 'APILoginController@APILogin');

Route::get('login', 'LoginController@showLogin');
Route::post('login', 'LoginController@doLogin');
Route::get('logout', 'LoginController@doLogout');

//Route::get('shoppinglist', 'ShoppingcartController@showShoppinglist');
Route::group(array('before' => 'auth'), function() {
    Route::get('shoppinglist', 'ShoppingcartController@showShoppinglist');
    Route::get('removefromshoppingcart/{itemcode}', 'ShoppingcartController@deleteItem');
});

Route::get('putinshoppingcart/{code}', 'ShoppingcartController@putInShoppingcart');