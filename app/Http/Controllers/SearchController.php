<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        if($request->has('q')) {
            return Book::search($request->get('q'))->get();
        }
    }
}
