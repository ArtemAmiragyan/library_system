@extends('layouts.app')

@section('content')
    <div class="container" xmlns:justify-content="http://www.w3.org/1999/xhtml">
        <ul class="list-group" style="margin-top: 10px">
                <li class="list-group-item">
                    <h2 style="text-align: center">{{$book->title}}</h2>
                    <h6>Author:
                        <a href="{{$book->author->path()}}">
                            {{$book->author->first_name}} {{$book->author->last_name}}
                        </a>
                    </h6>
                </li>
                <li class="list-group-item">
                    <p>{{$book->description}}</p>
                </li>
        </ul>

    </div>
@endsection
