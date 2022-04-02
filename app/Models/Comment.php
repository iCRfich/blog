<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{
    use HasFactory;

    public function User()
    {
        return $this->belongsTo(user::class);
    }

    public function storeComment($request)
    {
        $comment = new Comment();
        $comment->post_id = $request->post_id;
        $comment->user_id = Auth::guest() ? NULL : Auth::id();
        $comment->email = $request->email;
        $comment->name = $request->name;
        $comment->text = $request->text;
        $comment->parent_id = $request->has('parent_id') ? $request->parent_id : NULL;
        $comment->save();
    }

    public function updateComment($request, $id)
    {
        $comment = Comment::find($id);
        $comment->text = $request->text;
        $comment->save();
    }

    public function answer($request,$post_id, $comment_id)
    {
        $comment = new Comment();
        $comment->post_id = $post_id;
        $comment->user_id = Auth::id();
        $comment->email = Auth::user()->email;
        $comment->name = Auth::user()->name;
        $comment->text = $request->text;
        $comment->parent_id = $comment_id;
        $comment->save();
    }
}

