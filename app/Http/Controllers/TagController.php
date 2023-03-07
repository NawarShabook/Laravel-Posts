<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $tags=Tag::all();
        return view('tags.index',['tags'=>$tags]);
    }


    public function create()
    {
        return view('tags.create');
    }
    public function show()
    {
        //
    }


    public function store(Request $request)
    {
        $request->validate([
            'tag' => 'required'
        ]);

        //mass assignment
        Tag::create([
            'tag' => $request->tag
        ]);

        return redirect()->back()->with('success','tag added successfully');
    }

    function edit($id)
    {
        $tag=Tag::find($id);
        return view('tags.edit',['tag'=>$tag]);
    }


    public function update(Request $request, $id)
    {
        $tag=Tag::find($id);
        $request->validate([
            'tag' => 'required'
        ]);
        $tag->tag= $request->tag;
        $tag->save();


        return redirect()->back()->with('success','tag updated successfully');
    }

    public function destroy($id)
    {
        $tag=Tag::find($id);
        $tag->delete();
        return redirect()->back()->with('success','tag deleted successfully');
    }
}
