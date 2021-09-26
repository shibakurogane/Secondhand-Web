<?php

namespace Database\Factories;

use App\Models\Comment;
use Faker\Factory as facker;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = facker::create('en_US');

        return [
            'content' => $faker->text(),
            'updated_at' => now(),
            'created_at' => now(),
        ];
    }
}
