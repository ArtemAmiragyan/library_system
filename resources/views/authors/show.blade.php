@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="media">
            <div class="media-body">
                <h5 class="mt-0">{{$author->first_name}} {{$author->last_name}} books:</h5>

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                    </tr>
                    </thead>
                    <tbody>
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
            </div>
        </div>
    </div>
@endsection
