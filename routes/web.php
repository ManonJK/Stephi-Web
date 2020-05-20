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

//Route::get('Annonces/{id}', function () {
//    return redirect(route('Annonces.show'));
//});

Route::get('Annonces/{id}', 'VenteController@show');

Route::resource('Annonces', 'VenteController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
