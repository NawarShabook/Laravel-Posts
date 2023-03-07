@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col">
            <div class="jumbotron">
                <h1 class="display-4">Trashed Posts</h1>
                <a class="btn btn-success" href="{{route('posts')}}">All Post</a>
                @if (Session::get('success'))
                <div class="alert alert-success" role="alert">
                    {{Session::get('success')}}
                </div>
                @endif
            </div>
        </div>

    </div>
    <div class="row">

        @if (count($posts) > 0)
            <div class="col">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">User</th>
                            <th scope="col">Date</th>
                            <th scope="col">Photo</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    @php
                        $i=1;
                    @endphp
                    <tbody>
                        @foreach ($posts as $post)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$post->title}}</td>
                            <td>{{$post->user->name}}</td>
                            <td>{{$post->created_at->diffForHumans()}}</td>
                            <td><img src="/{{$post->photo}}" width="100" height="70" class="tumbnail" alt="{{$post->photo}}"></td>
                            <td>
                                <a href="{{route('post.show',$post->slug)}}"><i class="fa-solid fa-2x fa-eye"></i></a> &nbsp;&nbsp;
                                <a title="restore" href="{{route('post.restore',$post->id)}}"><i class="fa-solid fa-2x fa-arrow-rotate-left"></i></a>&nbsp;&nbsp;
                                <a title="permanently delete" class="text-danger" href="{{route('post.hardDelete',$post->id)}}"><i class="fa-solid fa-2x fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-danger" role="alert">
                Empty Trashed
            </div>
        @endif
    </div>
</div>

@endsection
