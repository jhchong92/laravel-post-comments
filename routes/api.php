<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('/me', 'AuthController@me');
    Route::post('/post', 'PostController@store');
});

Route::get('/posts', 'PostController@index');
Route::get('/posts/{post}', 'PostController@show');

Route::get('/comments', 'CommentController@index');
Route::post('/posts/{post}/comment', 'CommentController@store');
