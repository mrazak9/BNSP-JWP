<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Menampilkan Seluruh Data Post
     *
     *
     */
    public function index()
    {
        $posts = Post::get();
        $tags = Tag::get();
        // $comment = Comment::groupBy('post_id')->count();
        return view('post.index', compact('posts','tags'));
    }
    /**
     * Menampilkan Form Create Post
     *
     * @return string
     */
    public function create()
    {
        return view('post.create');
    }
    /**
     * Menyimpan Data Post
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
        $input['media_url'] = 'media/post/' . $file->getClientOriginalName();
        $save = Post::create($input);

        $hashtag_string = $request->body;
        $str = $hashtag_string;
        preg_match_all('/#(\w+)/', $str, $matches);
        foreach ($matches[1] as $hashtag_name) {
            $hashtag = new Tag();
            $hashtag->value = $hashtag_name;
            $hashtag->post_id = $save->id;
            $hashtag->save();
        }
        $file->move('media/post', $file->getClientOriginalName());
        return redirect()->route('posts.index');
    }
    /**
     * Menampilan Data Post berdasarkan ID
     *
     * @return string
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('post.show', compact('post'));
    }

    /**
     * Menampilan Data Post yang akan di edit berdasarkan ID
     *
     * @return string
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return view('post.edit', compact('post'));
    }

    /**
     * Menyimpan Data Post yang telah di edit berdasrkan ID
     *
     * @return string
     */
    public function update($postId, Request $request)
    {
        $data = $request->all();
        $file = $request->file('media_url');
        $data['media_url'] = 'media/post/' . $file->getClientOriginalName();
        $post = Post::findorFail($postId);
        $post->body = $data['body'];
        $post->media_url = $data['media_url'];
        $post->save();

        $file->move('media/post', $file->getClientOriginalName());
        return redirect()->route('posts.index');
    }
    /**
     * Menghapus Data Post berdasarkan ID
     *
     * @return string
     */

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect()->route('posts.index');
    }

    // mengambil data dari table post sesuai pencarian data
    public function cari(Request $request)
    {
        return $request->all();
        $tags = Tag::get();
        $cari = $request->cari;
        $posts = Post::with('Tag')->whereHas('Tags', function ($query) use ($cari) {
            return $query->where('id', $cari );
        })->paginate(10);

        // return $users;
        if ($cari) {
            return view('posts.index', compact('posts','tags'));
        }else {
            # code...
            return redirect('home');
        }
    }
}
