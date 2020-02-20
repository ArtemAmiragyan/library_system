<?php

namespace App\Http\Controllers;

use App\Http\Requests\Reviews\ReviewStore;
use App\Review;
use App\Book;
use Illuminate\Auth\Access\AuthorizationException;
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
     * Update an existing review.
     *
     * @param Review $review
     * @throws AuthorizationException
     */
    public function update(ReviewStore $request, Review $review)
    {
        $this->authorize('update', $review);

        $review->update($request->all());
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
    }
}
