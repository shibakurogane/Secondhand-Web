<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\FollowPost;
use App\Models\FollowUser;


class FollowController extends Controller
{
    public function addFollowPost($id)
    {
        $user=User::find(auth('sanctum')->user()->id);
        $followPost=FollowPost::create([
            'user_id'=>$user->id,
            'post_id'=>$id,
        ]);
        return response()->json([$followPost]);
    }

    public function addFollowingUser($id)
    {
        $user=User::find(auth('sanctum')->user()->id);
        $followUser=FollowUser::create([
            'user_id'=>$user->id,
            'following_id'=>$id,
        ]);
        return response()->json([$followUser]);
    }

    public function allFollowPost()
    {
        $user=User::find(auth('sanctum')->user()->id);
        $followPost=FollowPost::where('user_id',$user->id)->get();
        $array=array();
        foreach($followPost as $postId)
        {
            array_push($array,$postId->post_id);
        }
        $post=Post::find($array);
        return response()->json([$post]);

    }

    public function allFollowingUser()
    {
        $user=User::find(auth('sanctum')->user()->id);
        $followingUser=FollowUser::where('user_id',$user->id)->get();
        $array=array();
        foreach($followingUser as $userId)
        {
            array_push($array,$userId->following_id);
        }
        $following=User::find($array);
        return response()->json([$following]);

    }
}
