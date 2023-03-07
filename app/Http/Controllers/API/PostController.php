<?php

namespace App\Http\Controllers\API;
use Illuminate\Support\Str;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends BaseController
{
    public function index()
    {
        $posts=Post::all();
        return $this->sendResponse(PostResource::collection($posts) , 'All Posts');
    }

    public function userPosts($id)
    {
        $posts=Post::where('user_id',$id)->get();
        if(is_null($posts)){
            return $this->sendError('Empty','this user has not posts');
        }
        return $this->sendResponse(PostResource::collection($posts) , 'All Posts for this user');
    }

    public function store(Request $request)
    {
        $input=$request->all();

        $validator=Validator::make($input,[
            'title' => 'required',
            'content' => 'required',
        ]);

        if($validator->fails())
        {
            return $this->sendError('validator errors',$validator->errors());
        }

        $user=Auth::user();
        $input['user_id']=$user->id;
        $slug = Str::slug($request->title);
        $input['slug']=$slug;
        $post=Post::create($input);
        return $this->sendResponse(new PostResource($post), 'post created successfully');
    }

    public function show($id)
    {
        $post=Post::find($id);

        if(is_null($post))
        {
            return $this->sendError('post not found');
        }
        return $this->sendResponse(new PostResource($post), 'post founded');
    }


    public function update(Request $request, Post $post)
    {
        $input=$request->all();

        $validator=Validator::make($input,[
            'title' => 'required',
            'content' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('validator errors',$validator->errors());
        }

        $post->title=$input['title'];
        $post->content=$input['content'];
        if(isset($input['photo'])){
            $post->photo=$input['photo'];
        }
        $post->save(); //for save it in database

        return $this->sendResponse(new PostResource($post), 'post updated successfully');
    }


    public function destroy($id)
    {
        $post=Post::where('id',$id)->first();
        if($post==null)
        {
            return $this->sendError('post not found');
        }
        $post->delete();
        return $this->sendResponse('success', 'post deleted successfully');
    }
}
