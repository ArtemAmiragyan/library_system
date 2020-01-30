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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
