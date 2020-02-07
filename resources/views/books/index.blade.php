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


        @foreach($books as $book)
            <ul class="list-group mt-3">
                <div class="list-group-item flex-column">
                    <div class="d-flex justify-content-between">
                        <a class href="{{$book->path()}}">
                            <h2>{{$book->title}}</h2>
                        </a>
                        <form method="POST" action="{{route('favorite', ['book' => $book->id])}}">
                            {{csrf_field()}}
                            <div class="form-group">
                                <button type="submit" class="btn btn-light" {{$book->isFavorited() ? 'disabled' : '' }}>
                                    {{ $book->favorites_count }} Favorite
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="list-group-item">
                    <p>{{$book->shortDescription}}...</p>
                </div>

            </ul>
        @endforeach
        <div class="mt-3">{{$books->links()}}</div>
    </div>
@endsection
