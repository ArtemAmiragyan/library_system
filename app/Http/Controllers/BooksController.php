<?php

namespace App\Http\Controllers;

use App\Author;
use App\Book;
use App\Http\Requests\Book\StoreBook;
use App\Review;
use Illuminate\Http\Request;
use App\Http\Requests\Book\UpdateBookRequest;
use Illuminate\Http\Response;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $books = Book::query();

        if ($request->has('book')) {
            $books = $books->where('title', 'LIKE', trim($request->input('book')) . '%');
        }

        $books = $books->paginate(5);
        return view('books.index', compact('books'));
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
     * @return Response
     */
    public function store(StoreBook $request)
    {
        $book = Book::create($request->all());

        return redirect($book->path());
    }

    /**
     * Display the specified resource.
     *
     * @param Book $book
     * @param Review $review
     * @return Response
     */
    public function show(Book $book, Review $review)
    {
        $review = Review::query();

        $reviews = $review->where('book_id', $book->id)->pluck('assessment')->toArray();
        if (count($reviews) > 0) {
            $assessment = round(array_sum($reviews) / count($reviews));
        } else {
            $assessment = null;
        }
        return view('books.show', compact('book', 'assessment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Book $book
     * @return Response
     */
    public function edit(Book $book)
    {
        $authors = Author::all();
        return view('books.edit', compact('book', 'authors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateBookRequest $request
     * @param Book $book
     * @return Response
     */
    public function update(StoreBook $request, Book $book)
    {
        $book->update($request->all());

        return redirect($book->path());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Book $book
     * @return Response
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect('/books');
    }
}
