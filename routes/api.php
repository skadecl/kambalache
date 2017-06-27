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

//Token-required
Route::group(['middleware' => 'jwt.auth'], function () {
  //User
  Route::resource('users', 'UserController', ['except' => ['edit']]);
  Route::get('users/{id}/items', 'UserController@items');
  Route::get('users/{id}/interests', 'UserController@interests');


  //Item
  Route::get('items', 'ItemController@index');
  Route::post('items', 'ItemController@create');
  Route::get('items/{id}', 'ItemController@show');
  Route::get('items/{id}/offers', 'ItemController@offers');
  Route::get('items/{id}/questions', 'ItemController@questions');
  Route::get('items/{id}/interested', 'ItemController@interested');


  //questions
  Route::post('questions', 'QuestionController@create');
  Route::patch('questions/{id}', 'QuestionController@update');

});

//Search
Route::get('search/items/normal', 'ItemController@open_search');
//Token Free
Route::get('categories', 'CategoryController@index');
