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



Route::any('/admin/product/new', 'ProductController@newProduct');
Route::get('/admin/products', 'ProductController@index');
Route::get('/admin/product/destroy/{id}', 'ProductController@destroy');
Route::any('/admin/product/save', 'ProductController@add');
Auth::routes();

Route::get('/home', 'MainController@index');
Route::get('/', 'MainController@index');

Route::group([ 'middleware' => 'auth'], function () {
    Route::get('/addProduct/{productId}', 'CartController@addItem');
    Route::get('/removeItem/{productId}', 'CartController@removeItem');
    Route::get('/cart', 'CartController@showCart');
});

Route::get('logout', array('before' => 'auth', function()
{
    Auth::logout();
    return Redirect::to('/');
}));