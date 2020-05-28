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

Auth::routes();


Route::get('/', function () {
    return redirect(route('Annonces.index'));
});

Route::resource('Annonces', 'VenteController');

Route::resource('Profil', 'UserController');

Route::resource('Favoris', 'FavoriController');

Route::resource('Biens', 'BienController');


Route::get('Annonces/{id}', 'VenteController@show');

Route::get('Annonces/cancel/{id}', 'VenteController@cancel');

Route::get('/Profil', 'UserController@show')->name('Profil');

Route::get('/Home', 'HomeController@index')->name('home');

Route::get('Favoris/del/{id}', 'FavoriController@destroy');

Route::get('Favoris/Store/{id}', 'FavoriController@store');

Route::get('Biens/edit/{id}', 'BienController@edit');



Route::post('Profil/{user}/update',  ['as' => 'Profil.update', 'uses' => 'UserController@update']);

Route::put('Biens/{bien}/update',  ['as' => 'Bien.update', 'uses' => 'BienController@update']);

Route::post('Profil/{user}/update/phone',  ['as' => 'Profil.update_phone', 'uses' => 'UserController@update_phone']);
