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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('users', 'UserController', ['except' => ['edit']]);
Route::get('users/{id}/items', 'UserController@items');

Route::resource('categories', 'CategoryController', ['except' => ['edit']]);
Route::get('categories/{id}/items', 'CategoryController@items');

Route::resource('items', 'ItemController', ['except' => ['edit']]);
Route::get('items/{id}/photos', 'ItemController@photos');
Route::get('items/{id}/offers', 'ItemController@offers');
