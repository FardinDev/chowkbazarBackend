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


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
