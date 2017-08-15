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

Route::get('/offers/{slug}/products', 'Api\ApiOffersController@index')->middleware('date');
Route::get('/offers/{slug}/products/{name}', 'Api\ApiOffersController@show')->middleware('dateRange');

//TO DO:

// RabbitMQ jako queue
//zmiana strony startowej

