<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
    //
    public function addComment(Request $request,$id)
    {
        $user = User::find(auth('sanctum')->user()->id);
        $post=Post::find($id);
        if($post==NULL) return response()->json(['Post not found']);
        $comment=Comment::create([
            'user_id'=>$user->id,
            'post_id'=>$id,
            'content'=>$request->content,
        ]);
        return response()->json([$comment]);
    }   

    public function allPostComment($id)
    {
        return response()->json(Comment::where('post_id',$id)->get());
    }
}
