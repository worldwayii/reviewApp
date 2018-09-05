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

//view and item
Route::get('item/{sku}', 'ItemController@show');
Route::get('item/review/{sku}', 'ItemController@showReview');
 
//post review route
Route::post('item/review/store', 'ItemController@storeReview');

//edit a review routes
Route::get('item/review/edit/{id}', 'ItemController@editReview');
Route::post('item/review/update', 'ItemController@updateReview');