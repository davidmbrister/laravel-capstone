<?php

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

// ADMIN ROUTES

Route::resource('items', 'ItemController');

Route::resource('categories', 'CategoryController');

// STORE ROUTES

Route::get('/', 'StoreController@getIndex');

Route::get('store', 'StoreController@getIndex')->name('store.index');

Route::get('store/product/{slug}',['as' => 'store.single', 'uses' => 'StoreController@getSingle'])->where('slug', '[\w\d\-\_]+');
// create a named route store.category; when route is followed it calls itemsByCategory  
Route::get('store/{category}',['as' => 'store.category', 'uses' => 'StoreController@itemsByCategory']);

// SHOPPING CART ROUTES

Route::get('shopping_cart',['as' => 'store.cartIndex', 'uses' => 'StoreController@cartIndex']);

Route::put('shopping_cart',['as' => 'shopping_cart.update_cart', 'uses' => 'StoreController@updateCart']);

Route::post('store/{id}/shopping_cart/{amount}',['as' => 'store.addToCart', 'uses' => 'StoreController@addToCart']);

Route::delete('store/shopping_cart/{id}',['as' => 'shopping_cart.remove_item', 'uses' => 'StoreController@deleteItemFromCart']);

// This will allow the entering of '/logout' to the URL to work via GET
// Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/home', 'HomeController@index')->name('home');

