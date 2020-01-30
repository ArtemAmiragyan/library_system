@extends('layouts.app')

@section('content')
    <div class="container">
        <form class="card card-sm">
            <div class="card-body row no-gutters align-items-center">
                <div class="col-auto">
                    <i class="fas fa-search h4 text-body"></i>
                </div>

                <div class="col">
                    <input class="form-control form-control-lg form-control-borderless" type="search" name="book"
                           placeholder="Search a book">
                </div>

                <div class="col-auto">
                    <button class="btn btn-lg btn-light" type="submit">Search</button>
                </div>

            </div>
        </form>

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
