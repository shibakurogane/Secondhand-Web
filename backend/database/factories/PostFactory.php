<?php

namespace Database\Factories;

use App\Models\Post;
use Faker\Factory as facker;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = facker::create('vi_VN');
        return [
            'title' => $faker->sentence(),
            'content' => $faker->paragraph(),
            'status' => $faker->numberBetween(0,1),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
