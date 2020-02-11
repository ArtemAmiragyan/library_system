<?php

namespace App\Http\Controllers;

use App\Review;
use App\User;

class ProfilesController extends Controller
{
    /**
     * Show the user's profile.
     *
     * @param User $user
     * @return Response
     */
    public function show(User $user)
    {
        $userReviews = Review::where('user_id', $user->id)->paginate(1);
        return view('profiles.show', compact('userReviews', 'user'));
    }
}
