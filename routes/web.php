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

Route::get('/', function () {
    return redirect(route('Annonces.index'));
});

Route::get('Annonces/{id}', 'VenteController@show');

Route::get('Annonces/cancel/{id}', 'VenteController@cancel');

Route::resource('Annonces', 'VenteController');

Route::resource('Profil', 'UserController');

Route::get('/Profil', 'UserController@show')->name('Profil');

Auth::routes();

Route::get('/Home', 'HomeController@index')->name('home');

Route::post('Profil/{user}/update',  ['as' => 'Profil.update', 'uses' => 'UserController@update']);

Route::post('Profil/{user}/update/phone',  ['as' => 'Profil.update_phone', 'uses' => 'UserController@update_phone']);

Route::get('Favoris/del/{id}', 'FavoriController@destroy');
