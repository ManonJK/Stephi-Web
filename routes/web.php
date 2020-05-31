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

use App\Mail\OffreMail;
use Illuminate\Support\Facades\Mail;

Auth::routes();


Route::get('/', function () {
    return redirect(route('Annonces.index'));
});

Route::get('/email', function () {
    Mail::to('email@email.com')->send(new OffreMail());

    return new OffreMail();
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

Route::get('Image/del/{id}', 'ImageController@destroy');

Route::get('Dependance/del/{id_bien}/{id_dep}', 'BienController@destroy_dep');

Route::get('Favoris/Store/{id}', 'FavoriController@store');

Route::get('Biens/edit/{id}', 'BienController@edit');



Route::post('Profil/{user}/update',  ['as' => 'Profil.update', 'uses' => 'UserController@update']);

Route::post('Profil/{user}/delete',  ['as' => 'Profil.destroy', 'uses' => 'UserController@destroy']);

Route::put('Biens/{id}/update',  ['as' => 'Bien.update', 'uses' => 'BienController@update']);

Route::post('Profil/{user}/update/phone',  ['as' => 'Profil.update_phone', 'uses' => 'UserController@update_phone']);

Route::post('/search', 'SearchController@filter');

Route::post('Dependance/create/{id}', ['as' => 'Dependance.create', 'uses' => 'BienController@create_dep']);

Route::put('Dependance/edit/{id_bien}/{id_dep}', ['as' => 'Dependance.update', 'uses' =>'BienController@update_dep']);

Route::post('Image/store/{id_bien}', ['as' =>'Image.store', 'uses'=>'ImageController@store']);

Route::post('Email/{id_sale}/{id_seller}', ['as' => 'Mail.send', 'uses'=>'UserController@send_offer_email']);
