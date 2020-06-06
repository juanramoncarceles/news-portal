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

// List news
Route::get('news', 'NewsController@index');

// List news categories
Route::get('categories', 'NewsCategoryController@index');

// List a single news
Route::get('news/{id}', 'NewsController@show');

// Create a new news
//Route::post('news', 'NewsController@store');
// Update a news
//Route::put('news', 'NewsController@store');
//
Route::match(['post', 'put'], 'news', 'NewsController@store');

// Delete a news
Route::delete('news/{id}', 'NewsController@destroy');