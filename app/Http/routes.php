<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::model('shops', 'Shop');
Route::model('products', 'Product');
Route::model('lists', 'SList');

Route::bind('products', function($value, $route) {
	return App\Product::whereSlug($value)->first();
});
Route::bind('shops', function($value, $route) {
	return App\Shop::whereSlug($value)->first();
});
Route::bind('lists', function($value, $route){
	return App\SList::whereSlug($value)->first();
});

Route::get('/', function(){
	return Redirect::away('/shops');
});

Route::resource('shops', 'ShopsController');
Route::resource('shops.products', 'ProductsController');
Route::resource('shops.lists', 'ListsController');
