@extends('layouts.app')
@section('content')
    <div class="container">
        <h4 class="text-center">Add Author</h4>

        <form method="POST" action="/authors">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" class="form-control" id="first_name" value="{{old('first_name')}}" name='first_name'>
            </div>

            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" class="form-control" id="last_name" value="{{old('last_name')}}" name='last_name'>
            </div>

            <div class="form-group">
                <label for="biography">Biography:</label>
                <textarea name="biography" id="biography" class="form-control">{{old('biography')}}</textarea>
            </div>

            <button type="submit" class="btn btn-secondary">Publish</button>
        </form>
        @if (count($errors) > 0)
            <div class="alert alert-danger" style="margin-top: 10px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endsection

