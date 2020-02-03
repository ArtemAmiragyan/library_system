@extends('layouts.app')

@section('content')
    <div class="container" xmlns:justify-content="http://www.w3.org/1999/xhtml">
        <ul class="list-group m-4">
            <li class="list-group-item">
                <h2 class="text-center break-word">{{$book->title}}</h2>
                <h6>Author:
                    <a href="{{$book->author->path()}}">
                        {{$book->author->first_name}} {{$book->author->last_name}}
                    </a>
                </h6>
            </li>
            <li class="list-group-item break-word">
                {{$book->description}}
            </li>
        </ul>

        <div class="row m-4">
            <a href="{{route('books.edit', $book)}}">
                <button type="submit" class="btn btn-link">Edit Book</button>
            </a>
            <form action="{{$book->path()}}" method="POST">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}

                <button type="submit" class="btn btn-link">Delete Book</button>
            </form>
        </div>
        <h4 class="text-center">Reviews</h4>
        @foreach($book->reviews as $review)
            <ul class="list-group m-4">
                <li class="list-group-item break-word">
                    <div class="row">
                        <h6>{{$review->owner->name}}</h6>
                    </div>
                </li>
                <li class="list-group-item break-word">
                    {{$review->body}}<br>
                    <small>assessment: {{$review->assessment}}</small>
                </li>
                <li class="list-group-item break-word">
                    <small class="text-muted"> {{ $review->created_at->diffForHumans() }}... </small>
                </li>
            </ul>
        @endforeach

        @if (auth()->check())
            <div class="column">
                <h5>Write a review!</h5>
                <form method="POST" action="{{route('review', ['book' => $book->id])}}">
                    {{csrf_field()}}
                    <div class="form-group">
                        <textarea class="form-control" name="body"
                                  placeholder="What you think about this book"></textarea>
                    </div>

                    <button type="submit" class="btn btn-light">Post</button>
                </form>
            </div>
        @else
            <p>Please <a href="{{route('login')}}">sign in </a>to write a review</p>
        @endif
    </div>
@endsection
