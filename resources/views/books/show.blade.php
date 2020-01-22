@extends('layouts.app')

@section('content')
    <div class="container" xmlns:justify-content="http://www.w3.org/1999/xhtml">
        <ul class="list-group" style="margin-top: 10px">
                <li class="list-group-item">
                    <h2>{{$book->title}}</h2>
                </li>
                <li class="list-group-item">
                    <p>{{$book->description}}</p>
                </li>
        </ul>
    </div>
@endsection
