<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::get();
        return view('post.index',compact('posts'));
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
        $file = $request->file('media_url');
        $request->validate([
            'body' => 'required',
        ]);
        Post::create($input);
        $file->move('media/post',$file->getClientOriginalName());
        $input['media_url'] = 'media/post/'.$file->getClientOriginalName();
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
}
