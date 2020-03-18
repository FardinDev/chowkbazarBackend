<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/categories', 'API\CategoryController@getCategories');

Route::get('/gen-slugs', 'API\CategoryController@genSlugs');

Route::get('/category-by-slugs', 'API\CategoryController@getCategoryBySlugs');

Route::get('/sliders', 'API\SliderController@getSliders');

Route::get('/featured', 'API\ProductController@getFeatured');
Route::get('/most-viewed', 'API\ProductController@getMostViewed');

Route::get('/new-arrival', 'API\ProductController@getNewArrival');