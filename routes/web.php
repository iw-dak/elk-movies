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

Route::view('/', 'pages.home');
Route::get('/show/filter/{platform}', 'HomeController@showFiltered')->name('movies.filtered');
Route::get('/show/blacklist/{platform}', 'HomeController@showBlacklist')->name('movies.all');
Route::get('/show/{platform}/{id}', 'HomeController@showDetails')->name('movie.see');
Route::get('/insert/{platform}/{id}', 'HomeController@insertMovie')->name('movie.insert');
Route::get('/delete/{platform}/{id}', 'HomeController@deleteMovie')->name('movie.delete');
