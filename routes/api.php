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


Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');

Route::get('/todos', 'TodoController@index');
Route::get('/todos/{todo}', 'TodoController@show');
//Route::post('/todos', 'TodoController@store');

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('/users', 'UserController@index');
    Route::get('users/{user}', 'UserController@show');
    Route::patch('users/{user}', 'UserController@update');
    Route::patch('/todos/{todo}', 'TodoController@update');
    Route::delete('/todos/{todo}', 'TodoController@destroy');
    Route::post('/todos', 'TodoController@store');
});

