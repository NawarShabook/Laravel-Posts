@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col">
            <div class="jumbotron">
                <h1 class="display-4">All tags</h1>
                <a class="btn btn-success" href="{{route('tags.create')}}">Create tag</a>
                @if (Session::get('success'))
                <div class="alert alert-success" role="alert">
                    {{Session::get('success')}}
                </div>
                @endif
            </div>
        </div>

    </div>
    <div class="row">

        @if (count($tags) > 0)
            <div class="col">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    @php
                        $i=1;
                    @endphp
                    <tbody>
                        @foreach ($tags as $tag)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$tag->tag}}</td>
                            <td>
                                <a title="edit"  href="{{route('tags.edit',$tag->id)}}"><i class="fa-solid fa-2x fa-pen-to-square"></i></a>&nbsp;&nbsp;
                                <form action="{{route('tags.destroy',$tag->id)}}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="delete" class="text-danger" style="border:none; background-color: transparent" ><i class="fa-solid fa-2x fa-trash"></i>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-danger" role="alert">
                No tags to display
            </div>
        @endif


    </div>
</div>

@endsection
