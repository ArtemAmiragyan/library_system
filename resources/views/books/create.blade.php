@extends('layouts.app')
@section('content')
    <div class="container">
        <h4 class="text-center">Add book</h4>

        <form method="POST" action="/books">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" value="{{old('title')}}" name='title'>
            </div>

            <div class="form-group">
                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Author</label>
                <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" name="author_id">
                    <option selected value="">Choose...</option>
                    @foreach($authors as $author)
                        <option value="{{$author->id}}">{{$author->first_name}} {{$author->last_name}}</option>
                    @endforeach
                </select>
                <a href="/authors/create">New Author</a>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" id="description" class="form-control">{{old('description')}}</textarea>
            </div>

            <button type="submit" class="btn btn-secondary">Publish</button>
        </form>
        @if (count($errors) > 0)
            <flash-error></flash-error>
            <div class="alert alert-danger m-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endsection
