<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('users', 'UserController@users');
Route::get('users/profile', 'UserController@profile')->middleware('auth:api');
Route::get('users/{id}', 'UserController@show')->middleware('auth:api');
Route::post('auth/register', 'AuthController@register');
Route::post('auth/login', 'AuthController@login');

Route::resource('articles', 'ArticleController')->middleware('auth:api');
