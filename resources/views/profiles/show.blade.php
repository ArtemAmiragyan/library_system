@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="page-header">
            <h1>
                {{ $user->name }}
                <small>Since {{ $user->created_at->diffForHumans() }}</small>
            </h1>
        </div>
        <hr>
        <h4>{{ $user->name }} reviews:</h4>
        @foreach($userReviews as $review)
            <ul class="list-group mb-4">
                <li class="list-group-item">
                    <h5><a href="{{$review->book->path()}}"> {{$review->book->title}}</a></h5>
                </li>
                <li class="list-group-item">
                    <p>{{$review->body}}</p>
                </li>
                <li class="list-group-item">
                    <small>Assessment: {{$review->assessment}}</small>
                </li>
            </ul>
        @endforeach
        {{$userReviews->links()}}
    </div>
@endsection
