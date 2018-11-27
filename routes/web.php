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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Attractie
Route::get('/', 'AttractieController@index');
Route::get('/beheerder', 'AttractieController@index');
Route::get('/create/attractie', 'AttractieController@create');
Route::get('/beheerder/attractie/edit/{id}', 'AttractieController@edit');
Route::post('/attractie/store', 'AttractieController@store');
Route::put('/beheerder/attractie/update/{attractie}', 'AttractieController@update');
Route::get('/logout', 'AttractieController@logout');
Route::delete('/beheerder/destroy/attractie/{id}', 'AttractieController@destroy');

// Reactie
Route::get('/attractie/{id}', 'ReactieController@show');
Route::post('/attractie/{id}/store/reactie', 'ReactieController@store');
Route::delete('/attractie/destroy/reactie/{id}', 'ReactieController@destroy');
Route::get('/attractie/edit/reactie/{id}', 'ReactieController@edit');
Route::post('/attractie/update/reactie/{id}', 'ReactieController@update');

// Product
Route::get('/create/product', 'ProductController@create');
Route::delete('/beheerder/destroy/product/{id}', 'ProductController@destroy');
Route::get('/beheerder/product/edit/{id}', 'ProductController@edit');
Route::post('/product/store', 'ProductController@store');
Route::post('/beheerder/product/update/{id}', 'ProductController@update');

// User
Route::get('/home', 'UserController@index');
Route::delete('/beheerder/destroy/gebruiker/{id}', 'UserController@destroy');
Route::post('/home/update/{id}/persoonsgegevens', 'UserController@updatePersoonsgegevens');
Route::post('/home/update/{id}/wachtwoord', 'UserController@updateWachtwoord');
Route::post('/home/update/{id}/profielfoto', 'UserController@updateProfielfoto');

// Winkel
Route::get('/winkel', 'AttractieController@index');
Route::post('/product/{id}/store/winkel', 'CartController@store');
Route::post('/product/{id}/update/winkel', 'CartController@update');

// Winkelwagen
Route::get('/winkelwagen', 'Cart_itemController@index');
Route::delete('/winkelwagen/destroy/{id}', 'Cart_itemController@destroy');
Route::post('/product/{id}/update/winkelwagen', 'Cart_itemController@update');
Route::delete('/product/{id}/destroy/product', 'Cart_itemController@destroy');
Route::delete('/winkelwagen/betalen{id}/destroy', 'CartController@destroy');

Route::get('/login', function () {
    return view('auth/login');
});

Route::get('/register', function () {
    return view('auth/register');
});

Auth::routes();
