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

Route::get('/', 'UserController@home')->name('home');
Route::get('/product/{id}', 'UserController@viewProduct')->name('product');
Route::get('/product/{id}/send-query', 'UserController@sendQuery')->name('product.send-query');
Route::get('/source-product', 'UserController@sourceProduct')->name('product.source');
Route::post('/source-product', 'UserController@sourceProductStore')->name('product.source.store');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
