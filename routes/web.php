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

//Home page route
Route::get('/', 'HomeController@index');

//documentation route
Route::get('documentation', 'HomeController@showDocumentation');

//Add Item
Route::get('add', 'ItemController@create');
Route::post('add/item', 'ItemController@storeItem');

Route::get('manufacturers', 'ItemController@showManufacturers');
Route::get('manufacturer/item/{sku}', 'ItemController@showManufacturerItems');

Route::group(['prefix' => 'item'], function() {

	//view and item
	Route::get('{sku}', 'ItemController@show');
	Route::get('review/{sku}', 'ItemController@showReview');
	 
	//post review route
	Route::post('review/store', 'ItemController@storeReview');

	//edit a review routes
	Route::get('review/edit/{id}', 'ItemController@editReview');
	Route::post('review/update', 'ItemController@updateReview');


	Route::get('edit/{sku}', 'ItemController@showItemEdit');
	Route::post('update', 'ItemController@updateItem');

	//delete an item
	Route::get('delete/{sku}', 'ItemController@destroyItem');
    
});


Route::get('items/highly-reviewed', 'ItemController@showByDesc');

Route::get('items/average-rating', 'ItemController@showAverageRating');