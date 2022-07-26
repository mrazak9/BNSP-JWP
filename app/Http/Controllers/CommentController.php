<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Membuat komentar baru
     *
     * @return string
    */
    public function store(Request $request)
    {
        $input = $request->all();
        $request->validate([
            'body'=>'required',
        ]);
        $input['user_id'] = auth()->user()->id;
        // return $comment;
        $save = Comment::create($input);
        $hashtag_string = $request->body;
        $str = $hashtag_string;
        preg_match_all('/#(\w+)/', $str, $matches);
        foreach ($matches[1] as $hashtag_name) {
            $hashtag = new Tag();
            $hashtag->value = $hashtag_name;
            $hashtag->comment_id = $save->id;
            $hashtag->post_id = $save->post_id;
            $hashtag->save();
        }
        return back();
    }

    /**
     * Menamplkan data komentar yang akan di edit berdasarkan ID
     *
     * @return string
    */
    public function edit($id)
    {
        $comment = Comment::find($id);
        return view('comment.edit',compact('comment'));
    }
    /**
     * Menyimpan Perubahan data berdasarkan ID
     *
     * @return string
    */
    public function update($commentId, Request $request)
    {
        $data = $request->all();
        $comment = Comment:: findorFail($commentId);
        $comment->body = $data['body'];
        $comment->save();

        $post = Post::find($comment->post_id);
        return view('post.show',compact('post'));
    }
    /**
     * Menghapus komentar Berdasarkan Id
     *
     * @return string
    */
    public function destroy($id)
    {
        $post = Comment::find($id);
        $post->delete();
        return redirect()->route('Comments.index');
    }
}
