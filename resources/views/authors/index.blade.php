@extends('layouts.app')

@section('content')
<div class="container">
    <table class="table" style="margin-top: 10pxts">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
        </tr>
        </thead>
        <tbody>
        @foreach($authors as $author)
        <tr>
            <th scope="row">{{$loop->index+1}}</th>
            <td>{{$author->first_name}}</td>
            <td>{{$author->last_name}}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
    {{$authors->links()}}
</div>
@endsection
