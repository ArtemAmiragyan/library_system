<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\RedirectResponse;

class FavoritesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Book $book
     * @return RedirectResponse
     */
    public function store(Book $book)
    {
        $book->addToFavorites(auth()->id());
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Book $book
     * @return RedirectResponse
     */
    public function destroy(Book $book)
    {
        $book->favorites()->where(['user_id' => auth()->id()])->delete();

        return back();
    }

}
