<?php

use App\Movies\MoviesRepository;

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
    return view('pages.home', ['movies' => []]);
});

Route::get('/database', 'MovieController@test');

Route::get('/search/{query?}', function (MoviesRepository $repository) {
    $movies = $repository->search((string) request('query'));
    // die($movies);
    return view('pages.home', [
        'movies' => $movies,
    ]);
});
