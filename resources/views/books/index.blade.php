@extends('layouts.app')

@section('content')
    <div class="container" xmlns:justify-content="http://www.w3.org/1999/xhtml">
            <ul class="list-group">
                @foreach($books as $book)
                <li class="list-group-item">
                    <a href="{{$book->path()}}">
                        <h2>{{$book->title}}</h2>
                    </a>
                </li>
                <li class="list-group-item">
                    <p>{{$book->shortDescription}}...</p>
                </li>
                @endforeach
                 {{$books->links()}}
            </ul>
    </div>
@endsection
