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
            <book :book="{{ $book }}"></book>
        @endforeach
        <div class="mt-3">{{$books->links()}}</div>
    </div>
@endsection
