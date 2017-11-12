<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'MarketsController@index')->name('home');
Route::get('/markets/{market}', 'MarketsController@show')->name('market');
Route::get('/markets/{market}/offers', 'MarketOffersController@index');
Route::post('/contact', 'ContactController@send');


Route::prefix('dashboard')->group(function () {

    // Authentication Routes...
    Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('/', 'Auth\LoginController@login');
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

    // Registration Routes...
    Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('/register', 'Auth\RegisterController@register');

    // Password Reset Routes...
    Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('/password/reset', 'Auth\ResetPasswordController@reset');


    Route::middleware('auth')->group(function () {

        Route::get('/offers-manager', 'DashboardController@indexOffers')->name('offers-manager');

        Route::get('/markets-manager', 'DashboardController@indexMarkets');

        Route::get('/markets', 'MarketsController@index');

        Route::get('/offers/types', 'OffersController@indexTypes');

        Route::get('/offers/origins', 'OffersController@indexOrigins');

        Route::delete('/offers', 'OffersController@destroy');

        Route::post('/offers', 'OffersController@store');

        Route::patch('/offers/{id}', 'OffersController@update');

        Route::get('/offers/stats/count', 'OffersStatsController@index');

        Route::get('/markets/{market}/logs', 'MarketLogsController@index');

        Route::delete('/markets/{market}/offers', 'MarketOffersController@destroy');
    });
});

