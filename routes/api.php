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

// - CLEANUP TEMPLATE CODE, CREATE NEW COMPONENTS

// MarketInfo component with google maps

// MongoDb relation Obiekt z danymi danej giełdy: adres, tel, www, połozenie
//zmiany w componencie google maps

//TO DO
//-relacje place -> offer i offer -> place
// dodanie do zwracanych danych na stale danych o miejscu
////wczytywanie danych z zakresu dat !!
//data wyswietlana w placeholderze
// Dla kazdego zapytanie AJAX dodaj obsługe błednego zapytania.
// Notifications for errors
//Navbar

// Cache dla zapytan
// validacja query stringów

//Testy reorganizacja controllerów

//zmiana strony startowej
// RabbitMQ jako queue


