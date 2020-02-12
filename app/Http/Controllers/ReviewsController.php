<?php

namespace App\Http\Controllers;

use App\Http\Requests\Reviews\ReviewStore;
use App\Review;
use App\Book;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    /**
     * Create a new ReviewsController instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Persist a new review.
     *
     * @param Book $book
     * @return RedirectResponse
     */
    public function store(ReviewStore $request, Book $book)
    {
        $book->addReview([
            'body' => request('body'),
            'assessment' => request('assessment'),
            'user_id' => auth()->id(),
        ]);

        return back()
            ->with('flash', 'Review has been published!');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Review $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Review $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update an existing review.
     *
     * @param Review $review
     */
    public function update(Review $review)
    {
        $this->authorize('update', $review);

        $this->validate(request(), ['body' => 'required']);

        $review->update(request(['body', 'assessment']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Review $review
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Review $review)
    {
        $this->authorize('delete', $review);

        $review->delete();
        return back()
            ->with('flash', 'Review has been deleted!');;
    }
}
