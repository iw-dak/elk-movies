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

Route::get('/fill','MovieController@fillPivot');
Route::prefix('/')->group(function () {
    Route::get('', 'MovieController@search');
    Route::post('', 'MovieController@search');
});
Route::post('/complete', 'MovieController@autoCompletion');
Route::get('/type/{type}', 'MovieController@searchByType');
Route::get('/country/{query}', 'MovieController@searchByCountry');
Route::get('/date/{query}', 'MovieController@searchByDate');
Route::get('/movies/top-score', 'MovieController@searchBest');


// Tests
Route::get('/db/test', 'MovieController@db');
// Route::get('/test', function () {
//     return view('pop');
// });
