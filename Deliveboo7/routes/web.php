<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Auth::routes();

//MAIN
Route::get('/', 'MainController@main')
->name('main');

//show restaurant
Route::get('/showRestaurant/{id}', 'MainController@restaurant')
-> name('show');

//Creazione nuovo piatto
Route::get('/createDish', 'HomeController@createDish')
->name('createDish');

Route::post('/store', 'HomeController@storeDish')
-> name('storeDish');

//modifica Piatto
Route::get('/editDish/{id}', 'HomeController@editDish')
-> name('editDish');
Route::post('/updateDish/{id}', 'HomeController@updateDish')
-> name('updateDish');

//eliminazione Piatto
Route::get('destroy/{id}/{userid}', 'HomeController@destroy')
-> name('destroy');

//mostra ordini
Route::get('/showOrders/{id}', 'HomeController@showOrders')
-> name('showOrders');

//LOGIN
Route::get('/testlogin', 'AuthController@index')
-> name('getLogin');
Route::post('post-login', 'AuthController@postLogin')
-> name('postLogin');

//REGISTER
Route::get('/registration', 'AuthController@registration')
-> name('getRegistration');
Route::post('/post-registration', 'AuthController@postRegistration')
-> name('postRegistration');

//Creazione nuovo ordine
Route::post('/createOrder', 'MainController@createOrder')
->name('createOrder');

Route::post('/storeOrder', 'MainController@storeOrder')
-> name('storeOrder');


//braintree
Route::post('/paymentDetails','BrainController@paymentDetails')
-> name('paymentDetails');

Route::get('/pay/{order}','BrainController@pay')
-> name('pay');

Route::post('/checkout/{order}', 'BrainController@checkout')
-> name('checkout');

//statistiche
Route::get('/statistiche/{id}', 'HomeController@statistiche')
-> name('statistiche');

//editStatus
Route::get('/status/{id}', 'HomeController@editStatus')
-> name('editStatus');

Route::get('/revertStatus/{id}', 'HomeController@revertStatus')
-> name('revertStatus');

//Footer
//chi siamo
Route::get('/chiSiamo', 'MainController@chiSiamo')
-> name('chiSiamo');

//Contattaci
Route::get('/contattaci', 'MainController@contattaci')
-> name('contattaci');

//Faq
Route::get('/faq', 'MainController@faq')
-> name('faq');
