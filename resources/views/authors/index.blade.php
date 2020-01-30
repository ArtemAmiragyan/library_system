@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h5>Filter</h5>
                <form action="/authors">
                    {{ csrf_field() }}
                    <div class="flex-column">
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="lessThree" id="les_" required>
                                <label class="form-check-label" for="lessThree">
                                    Less than three books
                                </label>
                            </div>
                        </div>
                        <button class="btn btn-light m-0" type="submit">Submit</button>
                    </div>
                </form>
            </div>
            <div class="col item">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($authors as $author)
                        <tr onmouseout="this.style.color =''"
                            onmouseover="this.style.color = '#ededed'; this.style.cursor= 'pointer'"
                            onclick="document.location = '{{$author->path()}}';">
                            <th scope="row">{{$loop->index+1}}</th>
                            <td>{{$author->first_name}}</td>
                            <td>{{$author->last_name}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{$authors->links()}}
            </div>
        </div>
    </div>

@endsection
