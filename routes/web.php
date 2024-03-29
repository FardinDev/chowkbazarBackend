<?php
use Illuminate\Support\Facades\App;

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

// Route::get('/', 'UserController@home')->name('home');
// Route::get('/products', 'UserController@allProducts')->name('product.all');
// Route::get('/get-parent-category', 'UserController@getParentCat')->name('get.parent_cat');
// Route::get('/product/{id}', 'UserController@viewProduct')->name('product');
// Route::post('/product/{id}/send-query', 'UserController@sendQuery')->name('product.send-query');
// Route::get('/source-product', 'UserController@sourceProduct')->name('product.source');
// Route::post('/source-product', 'UserController@sourceProductStore')->name('product.source.store');

// Route::get('/search-product', 'UserController@searchProduct')->name('product.search');
// Route::get('/recommended-data', 'UserController@recommended')->name('get.recommended.data');
// Route::get('/tags', 'UserController@tags')->name('get.tags');
// Route::get('/eloquent', 'UserController@eloquent');
// Route::get('/order-by', 'UserController@orderBy')->name('get.order.by');
// Route::get('/store-primary', 'UserController@storePrimary');
// Route::get('/store-others', 'UserController@storeOthers');

 
// Route::get('/notification', function(){
// return view('notification');
// });

// Route::get('/test', function(){
//     event(new App\Events\MyEvent('hi'));
// });
// Route::get('/clear-cache', function() {
//     Artisan::call('cache:clear');
//     return "Cache is cleared";
// });

    Voyager::routes();

