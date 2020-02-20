<?php

namespace App\Http\Controllers;

use App\Author;
use App\Book;
use App\Http\Requests\Book\StoreBook;
use App\Review;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('books.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $authors = Author::all();

        return view('books.create', compact('authors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreBook $request
     * @return RedirectResponse|Redirector
     */
    public function store(StoreBook $request)
    {
        $book = Book::create($request->all());

        return redirect($book->path())
            ->with('flash', 'Book has been published!');
    }

    /**
     * Display the specified resource.
     *
     * @param Book $book
     * @param Review $review
     * @return Factory|View
     */
    public function show(Book $book, Review $review)
    {
        $assessment = null;

        $assessment = round($review->where('book_id', $book->id)->average('assessment'));

        return view('books.show', compact('book', 'assessment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Book $book
     * @return Factory|View
     */
    public function edit(Book $book)
    {
        $authors = Author::all();
        return view('books.edit', compact('book', 'authors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreBook $request
     * @param Book $book
     * @return RedirectResponse|Redirector
     */
    public function update(StoreBook $request, Book $book)
    {
        $book->update($request->all());

        return redirect($book->path())
            ->with('flash', 'Book has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Book $book
     * @return RedirectResponse|Redirector
     * @throws Exception
     */
    public function destroy(Book $book)
    {
        $book->reviews()->delete();
        $book->delete();

        return redirect('/books')
            ->with('flash', "Book '{$book->title}' has been deleted!");
    }

    public function getBooks()
    {
        return Book::all();
    }
}
