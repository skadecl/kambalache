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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Auth routes
Route::post('auth/sign_in', 'Auth\AuthController@sign_in');
Route::post('auth/sign_up', 'Auth\AuthController@sign_up');

Route::group(['middleware' => 'jwt.auth'], function () {
  //User
  Route::resource('users', 'UserController', ['except' => ['edit']]);
  Route::get('users/{id}/items', 'UserController@items');

  //Cateogry
  Route::resource('categories', 'CategoryController', ['except' => ['edit']]);
  Route::get('categories/{id}/items', 'CategoryController@items');

  //Item
  Route::resource('items', 'ItemController', ['except' => ['edit']]);
  Route::get('items/{id}/photos', 'ItemController@photos');
  Route::get('items/{id}/offers', 'ItemController@offers');
});
