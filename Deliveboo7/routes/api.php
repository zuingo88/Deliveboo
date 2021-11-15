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

// Route che torna tutte le categorie
Route::get('/get/categories','ApiController@getCategories') -> name('getCategoriesLink');

// Route che torna tutti i ristoranti
Route::get('/get/all/restaurants','ApiController@getAllRestaurants') -> name('getAllRestaurantsLink');

//Rotta che restituisce tutti i ristoranti
// Route::get('/getRestaurants','ApiController@getRestaurants') -> name('getRestaurants');
