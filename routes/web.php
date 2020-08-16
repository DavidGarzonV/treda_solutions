<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'TemplateController@getTemplate')->name("home");

//Store routes
Route::resource('store', 'Store\StoreController');

//Product routes
Route::get('product/{id_tienda}', 'Store\ProductController@index')->name("product.index");
Route::get('product/{id_tienda}/create', 'Store\ProductController@create')->name("product.create");
Route::post('product/create', 'Store\ProductController@store')->name("product.store");
Route::get('product/{id}/edit', 'Store\ProductController@update')->name("product.update");
Route::put('product/{id}/edit', 'Store\ProductController@edit')->name("product.edit");
Route::delete('product/{id}', 'Store\ProductController@destroy')->name("product.destroy");

//Test routes
Route::resource('test', 'TestController');