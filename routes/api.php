<?php


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


Route::prefix('dashboard')->group(function () {
    Route::get('/offers/entries', 'Api\Dashboard\ApiOffersController@showDistinctEntries')->middleware('dateRange');
    Route::delete('/offers', 'Api\Dashboard\ApiOffersController@destroy')->middleware('date');
    Route::delete('/offers/selected', 'Api\Dashboard\ApiOffersController@destroySelected');
    Route::get('/offers', 'Api\Dashboard\ApiOffersController@index');
    Route::post('/offers', 'Api\Dashboard\ApiOffersController@store');
    Route::patch('/offers/{id}', 'Api\Dashboard\ApiOffersController@update');

});




