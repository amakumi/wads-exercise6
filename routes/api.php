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

//Auth::routes();

Route::post('register', 'API\RegisterController@register');
Route::post('login','API\RegisterController@login');

Route::middleware('auth:api')->group(function()
{
    Route::post('events/create', 'API\EventController@create');
    Route::post('events/update', 'API\EventController@update');
    Route::get('events/showAll', 'API\EventController@index');
    Route::get('events/show/{id}', 'API\EventController@show');
    Route::post('events/update/{id}', 'API\EventController@update');
    Route::get('events/delete/{id}', 'API\EventController@destroy');
});

Route::middleware('auth:api')->get('/user', function (Request $request)
{
    return $request->user();
});

Route::middleware('auth:api','setAdmin')->group(function()
{
    Route::post('admin/makeMeAdmin', 'API\AdminController@makeMeAdmin');
});
