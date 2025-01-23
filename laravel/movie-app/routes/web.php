<?php
//edit pages here not edited yet
use Illuminate\Support\Facades\Route;
use app\Http\Controllers\MovieController;

//Route::get('/', 'MoviesController@index')->name('movies.index');
Route::get('/', [MovieController::class, 'index'])->name('movies.index');
Route::get('/movies/{movie}', [MovieController::class, 'show'])->name('movies.show');



// Route::get('/', 'MoviesController@index')->name('movies.index');
// Route::get('/movies/{id}', 'MoviesController@show')->name('movies.show');

// Route::get('/tv', 'TvController@index')->name('tv.index');
// Route::get('/tv/{id}', 'TvController@show')->name('tv.show');

// Route::get('/actors', 'ActorsController@index')->name('actors.index');
// Route::get('/actors/page/{page?}', 'ActorsController@index');

// Route::get('/actors/{id}', 'ActorsController@show')->name('actors.show');