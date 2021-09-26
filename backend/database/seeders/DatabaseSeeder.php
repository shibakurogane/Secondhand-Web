<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
use App\Models\Good;
use App\Models\Comment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create()->each(function ($user) {
            Post::factory(5)->create([
                'user_id'=>$user->id,
            ])->each(function($post){
                Good::factory(3)->create([
                    'user_id' => $post->user_id,
                    'post_id' => $post->id,
                ]);
                Comment::factory(3)->create([
                    'user_id' => $post->user_id,
                    'post_id' => $post->id,
                ]);
            });
        });
    }
}
