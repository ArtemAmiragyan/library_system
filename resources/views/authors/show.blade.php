@extends('layouts.app')
@section('content')
    <div class="container">
                <h2 class="mt-0" style="text-align: center">{{$author->first_name}} {{$author->last_name}} </h2>

                <blockquote class="blockquote text-center">
                    <p class="mb-0" style="word-wrap:break-word">{{$author->biography}}</p>
                </blockquote>

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                    </tr>
                    </thead>
                    <tbody>
                    <h5 class="mt-0">{{$author->first_name}} {{$author->last_name}} books:</h5>
                    @foreach($author->books as $book)
                    <tr>
                        <th scope="row">{{$loop->index+1}}</th>
                        <td>
                            <a href="{{$book->path()}}">
                                {{$book->title}}
                            </a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>

                <a href="/books/create">Add new Book</a>

    </div>
@endsection
