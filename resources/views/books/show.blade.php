@extends('layouts.app')

@section('content')
    <div class="container" xmlns:justify-content="http://www.w3.org/1999/xhtml">
        <ul class="list-group" style="margin-top: 10px">
            <li class="list-group-item">
                <h2 class="text-center break-word" >{{$book->title}}</h2>
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
        <div class="row">
            <a href="{{route('books.edit', $book)}}">
                <button type="submit" class="btn btn-link">Edit Book</button>
            </a>
            <form action="{{$book->path()}}" method="POST">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}

                <button type="submit" class="btn btn-link">Delete Book</button>
            </form>
        </div>
    </div>
@endsection
