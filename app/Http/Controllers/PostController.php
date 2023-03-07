<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;


class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $posts=Post::latest()->get();
        return view('posts.index',['posts'=>$posts]);
    }

    public function trashed()
    {
        $posts=Post::onlyTrashed()->orderBy('updated_at','desc')->where('user_id',Auth::id())->get();
        if($posts==null)
        {
            return redirect()->back();
        }
        return view('posts.trashed',['posts'=>$posts]);
    }


    public function create()
    {
        $tags=Tag::all();
        if($tags->count()==0)
        {
            return redirect()->route('tags.create');
        }
        return view('posts.create' ,['tags' => $tags]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'tags' => 'required',
            'photo' => 'required|image',
        ]);

        $photo=$request->photo;
        $newPhotoName=time().$photo->getClientOriginalName();
        $photo->move('uploads/posts',$newPhotoName);

        //mass assignment
        $post=Post::create([
            'user_id'=>Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
            'photo' => 'uploads/posts/'.$newPhotoName,
            'slug' => Str::slug($request->title)
        ]);
        $post->tags()->attach($request->tags);
        return redirect()->back()->with('success','post added successfully');
    }

    public function show($slug)
    {
        //first() مشان في حال كا في اكتر من واحد يجيب الاول

        $post=Post::where('slug',$slug)->first();
        $tags=Tag::all();
        return view('posts.show',['post'=>$post , 'tags'=>$tags]);
    }

    function edit($id)
    {
        $post=Post::where('id',$id)->where('user_id',Auth::id())->first();
        if($post==null)
        {
            return redirect()->back();
        }
        $tags=Tag::all();
        return view('posts.edit',['post'=>$post , 'tags'=>$tags]);
    }

    public function update(Request $request, $id)
    {
        $post=Post::find($id);
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);
        if($request->has('photo'))
        {
            $photo=$request->photo;
            $newPhotoName=time().$photo->getClientOriginalName();
            $photo->move('uploads/posts/',$newPhotoName);
            $post->photo='uploads/posts/'.$newPhotoName;
        }
        $post->title= $request->title;
        $post->content= $request->content;
        $post->save();
        $post->tags()->sync($request->tags);
        return redirect()->back()->with('success','post updated successfully');;
    }


    public function destroy($id)
    {
        $post=Post::where('id',$id)->where('user_id',Auth::id())->first();
        if($post==null)
        {
            return redirect()->back();
        }
        $post->delete();
        return redirect()->back()->with('success','post deleted successfully');
    }
    public function hardDelete($id)
    {
        $post=Post::withTrashed()->where('id',$id)->first();
        $post->forceDelete();
        return redirect()->back()->with('success','post permanently deleted successfully');
    }
    public function restore($id)
    {
        $post=Post::withTrashed()->where('id',$id)->first();
        $post->restore();
        return redirect()->back()->with('success','post restored successfully');
    }

    public function tag_posts($tag_id)
    {
        $tag=Tag::find($tag_id);
        $posts=$tag->posts;
        return view('posts.index',['posts'=>$posts ,'tag'=>$tag->tag]);
    }
}
