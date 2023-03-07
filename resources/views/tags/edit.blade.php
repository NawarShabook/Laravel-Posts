@extends('layouts.app')
@section('content')


<div class="container">
    <div class="row">
        <div class="col">
            <div class="jumbotron">
                <h1 class="display-4">Edit Tags</h1>
                <a class="btn btn-success" href="{{route('tags.index')}}">All Tags</a>
                @if (Session::get('success'))
                <div class="alert alert-success" role="alert">
                    {{Session::get('success')}}
                </div>
                @endif

            </div>
        </div>
    </div>

    <div class="row">
        @if ($errors->all())
            <ul class="text-danger">
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        @endif

        <div class="col">
            <form action="{{route('tags.update',$tag->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="tag" value="{{$tag->tag}}" class="form-control" required autofocus>
                </div>

                <input type="submit" value="save" class="btn btn-success">
            </form>
        </div>
    </div>

</div>
@endsection
