@extends('layouts.app')
@section('content')


<div class="container">
    <div class="row">
        <div class="col">
            <div class="jumbotron">
                <h1 class="display-4">Edit Post</h1>
                <a class="btn btn-success" href="{{route('posts.index')}}">All Posts</a>
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
            <form action="{{route('posts.update',$post->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" value="{{$post->title}}" class="form-control" required autofocus>
                </div>
                <div class="form-group">
                    @foreach ($tags as $tag)
                    <input type="checkbox" name="tags[]"
                        value="{{$tag->id}}"
                        @foreach ($post->tags as $ptag)
                            @if ($ptag->id == $tag->id)
                                checked
                            @endif
                        @endforeach

                    >
                    <label for="">{{$tag->tag}}</label>&nbsp;&nbsp;&nbsp;&nbsp;
                    @endforeach
                </div>
                <div class="form-group">
                    <label >Content</label>
                    <textarea class="form-control" name="content" rows="3">
                        {{$post->content}}
                    </textarea>
                </div>

                <div class="form-group">
                    <label>Photo</label>
                    <input type="file" name="photo" class="form-control">
                </div>
                <input type="submit" value="save" class="btn btn-success">
            </form>
        </div>
    </div>


</div>
@endsection
