<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/get_user_cart', function () {
    return auth::user()->get_products_cart();
});



Route::get('/add_to_cart/{product_id}', [
    'uses' => 'ProductController@add_to_cart',
    'as' => 'product.addtocart'
]);
Route::get('/product/{product_id}', [
    'uses' => 'ProductController@get_product',
    'as' => 'product.getproduct'
]);
Route::get('/getproductimage/{id}', [
    'uses' => 'ProductController@get_image',
    'as' => 'product.get_image'
]);

Route::get('/remove_product_carte/{product_id}', [
    'uses' => 'ProductController@remove_product_carte',
    'as' => 'product.remove_product_carte'
]);

Route::get('/add_product_to_favoris/{product_id}', [
    'uses' => 'ProductController@add_product_to_favoris',
    'as' => 'product.add_product_to_favoris'
]);

Route::get('/remove_product_favoris/{product_id}', [
    'uses' => 'ProductController@remove_product_favoris',
    'as' => 'product.remove_product_favoris'
]);
Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/is_product_favoris/{product_id}', [
    'uses' => 'ProductController@is_product_favoris',
    'as' => 'product.is_product_favoris'
]);

