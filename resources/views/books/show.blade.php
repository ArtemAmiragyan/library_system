@extends('layouts.app')

@section('content')
    <div class="container">
        <ul class="list-group m-4">
            <li class="list-group-item">
                <h2 class="text-center break-word">{{$book->title}}</h2>
                <h6>Author:
                    <a href="{{$book->author->path()}}">
                        {{$book->author->first_name}} {{$book->author->last_name}}
                    </a>
                </h6>
                @if($assessment != null)
                    <small class="text-muted">Rating:
                        {{$assessment}}
                    </small>
                @endif
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

        @if (auth()->check())
            <div class="column">
                <h5>Write a review!</h5>
                <form method="POST" action="{{route('review', ['book' => $book->id])}}">
                    {{csrf_field()}}
                    <div class="form-group">
                        <textarea class="form-control" name="body"
                                  placeholder="What you think about this book">{{old('body')}}</textarea>
                    </div>
                    <h6>Leave a rating!</h6>
                    <div class="form-group">
                        <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref"
                                name="assessment">
                            <option value="">Choose...</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-light">Post</button>
                </form>
            </div>

            @if (count($errors) > 0)
                <flash-error></flash-error>
                <div class="alert alert-danger m-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        @else
            <p>Please <a href="{{route('login')}}">sign in </a>to write a review</p>
        @endif
        @foreach($book->reviews as $review)
            <ul class="list-group m-4">
                <li class="list-group-item break-word">
                    <div class="row">
                        <h6>
                            <a href="{{route('profile', $review->owner->id)}}">
                                {{$review->owner->name}}
                            </a>
                        </h6>
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

    </div>
@endsection
