<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Good;
use App\Models\Category;
use App\Models\GoodCategory;


class PostController extends Controller
{
    public function show()
    {
        $post=Post::paginate(10);
        return response()->json([$post]);
    }
    public function get($id)
    {
        $post=Post::find($id);
        if($post==NULL) return response()->json(["Post doesn't exist"]);
        $good=Good::find($post->id);
        return response()->json(['post'=>$post,'good'=>$good]);
    }
    public function searchPost(Request $request,$id)
    {
        $goods=Good::where('name','like','%'.$request->name.'%')->get();
        $categories=Category::where('name','like','%'.$request->name.'%')->get();
        
        foreach($categories as $category)
        {
            $goods=$goods->merge($category->goods()->get());
        }

        $goods=$goods->toQuery();
        $goods=$goods->paginate(10,'*','page',$id);
        return response()->json([$goods]);

    }
    public function getAnotherUserPosts($id)
    {
        $post=Post::where('user_id',$id)->paginate(10);
        return response()->json([$post]);
    }
    public function getAllUserPosts()
    {
        
        $user = User::find(auth('sanctum')->user()->id);
        $post=Post::where('user_id',$user->id)->paginate(10);
        return response()->json([$post]);
    }
    public function edit(Request $request,$id)
    {
        $user = User::find(auth('sanctum')->user()->id);
        $post=Post::find($id);
        if($post==NULL||$user->id!=$post->user_id) return response()->json(["Post doesn't exist"]);
        $post->update($request->all());
        return response()->json(['post'=>$post]);

    }
    public function create(Request $request)
    {
        $user = User::find(auth('sanctum')->user()->id);
        if(!$request->hasFile('image')) {
            return response()->json(['upload_file_not_found'], 400);
        }
        $file = $request->file('image');
        if(!$file->isValid()) {
            return response()->json(['invalid_file_upload'], 400);
        }
        $post=Post::create([
            'title'=>$request->title,
            'content' =>$request->content,
            'status' =>false,
            'user_id'=>$user->id,
        ]);
        $good=Good::create([
            'name'=> $request->name,
            'user_id'=>$post->user_id,
            'post_id'=>$post->id,
            'detail'=>$request->detail,
            'price'=>$request->price,
        ]);
        $path = public_path() . "/storage/uploads/goods/";
        $file->move($path, $good->id .'.jpg');
        $good->update([
            'image'=>"/storage/uploads/goods/" .$good->id .'.jpg',

        ]);
        $array=array();
        $categories=explode(',',$request->categories);
        foreach($categories as $i)
        {
            $category=Category::where('name',$i)->first();
            if($category==NULL) $category=Category::create(['name'=>$i]);
            array_push($array,$category->id);
        }
        $good->categories()->sync($array);
        return response()->json(['post'=>$post,'good'=>$good,'categories'=>$array]);
    }

}
