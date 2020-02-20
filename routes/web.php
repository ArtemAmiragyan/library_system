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
    return redirect('/authors');
});

Route::resource('authors', 'AuthorsController', ['only' => ['index', 'show', 'create', 'store']]);

Route::resource('books', 'BooksController', ['only' => ['create', 'show', 'index', 'store', 'destroy', 'edit', 'update']]);

Route::get('getBooks', 'BooksController@getBooks');

Route::post('/reviews/{book}/', 'ReviewsController@store')->name('review');
Route::delete('/reviews/{review}', 'ReviewsController@destroy')->name('review.delete');
Route::patch('/reviews/{review}', 'ReviewsController@update');
Auth::routes();

Route::get('/profiles/{user}', 'ProfilesController@show')->name('profile');
Route::get('/home', 'HomeController@index')->name('home');

Route::post('/books/{book}/favorites', 'FavoritesController@store')->name('favorite');
Route::delete('/books/{book}/favorites/delete', 'FavoritesController@destroy')->name('favorite.destroy');

Route::get('search', [
    'as' => 'books.search',
    'uses' => 'SearchController@search'
]);