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
    Route::get('/order/lists', 'OrderController@lists');
    Route::get('/order/result/{id}', 'OrderController@result');
    Route::get('/order/result1/{id}', 'OrderController@result1');
    Route::any('/order/result2', 'OrderController@result2');

    Route::any('/order/te/{id1}/{id2}', 'OrderController@te');
    Route::get('/lists2', 'OrderController@lists2');
    Route::get('/lists1', 'OrderController@lists1');

});

Route::any('/order/result22', 'OrderController@result22');
Route::any('/order/result23', 'OrderController@result23');



Route::get('logout', array('before' => 'auth', function()
{
    Auth::logout();
    return Redirect::to('/');
}));