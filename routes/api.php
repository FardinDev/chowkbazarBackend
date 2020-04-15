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

Route::get('/get-mobile-menu', 'API\MenuController@getMobileMenu');

Route::get('/gen-slugs', 'API\CategoryController@genSlugs');


Route::get('/category-by-slug/{slug}', 'API\CategoryController@getCategoryBySlug');
Route::get('/category-by-slugs', 'API\CategoryController@getCategoryBySlugs');

Route::get('/sliders', 'API\SliderController@getSliders');

Route::get('/featured', 'API\ProductController@getFeatured');
Route::get('/most-viewed', 'API\ProductController@getMostViewed');

Route::get('/new-arrival', 'API\ProductController@getNewArrival');


Route::get('/get-product/{slug}', 'API\ProductController@getProductBySlug');

Route::get('/get-product-description/{slug}', 'API\ProductController@getProductDescriptionBySlug');

Route::get('/get-related-products', 'API\ProductController@getRelatedProducts');

Route::post('/store-query', 'API\ProductController@storeQuery');

Route::post('/store-source-product', 'API\ProductController@storeSourceProduct');

Route::post('/get-product-list', 'API\ProductController@getproductList');


Route::post('/get-all-category-slug', 'API\CategoryController@getAllIds');

Route::post('/search-product', 'API\SearchController@search');


Route::get('/generate-product-count', 'API\CategoryController@generateProductCount');
