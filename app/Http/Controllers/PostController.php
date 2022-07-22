<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::get();
        $comment = Comment::groupBy('post_id')->count();
        return view('post.index',compact('posts','comment'));
    }
    /**
     * Write Your Code..
     *
     * @return string
    */
    public function create()
    {
        return view('post.create');
    }
    /**
     * Write Your Code..
     *
     * @return string
    */
    public function store(Request $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();
        $request->validate([
            'body' => 'required',
        ]);
        $file = $request->file('media_url');
        $input['media_url'] = 'media/post/'.$file->getClientOriginalName();
        Post::create($input);
        $file->move('media/post',$file->getClientOriginalName());
        return redirect()->route('posts.index');
    }
    /**
     * Write Your Code..
     *
     * @return string
    */
    public function show($id)
    {
        $post = Post::find($id);

        return view('post.show',compact('post'));
    }

    public function edit($id)
    {
        $post = Post::find($id);
        return view('post.edit',compact('post'));
    }

    public function update($postId, Request $request)
    {
        $data = $request->all();
        $file = $request->file('media_url');
        $data['media_url'] = 'media/post/'.$file->getClientOriginalName();
        $post = Post:: findorFail($postId);
        $post->body = $data['body'];
        $post->media_url = $data['media_url'];
        $post->save();

        $file->move('media/post',$file->getClientOriginalName());
        return redirect()->route('posts.index');
    }
}
