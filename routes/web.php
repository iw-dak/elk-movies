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
Route::get('/show/all/{platform}', 'HomeController@showAll')->name('movies.all');
Route::get('/show/{platform}/{id}', 'HomeController@showDetails')->name('movie.see');
Route::get('/insert/{id}', 'HomeController@insertMovie')->name('movie.insert');
