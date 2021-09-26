<?php

namespace Database\Factories;
use Faker\Factory as facker;
use App\Models\Good;
use Illuminate\Database\Eloquent\Factories\Factory;

class GoodFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Good::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = facker::create('en_US');

        return [
            'name' => $faker->name(),
            'detail' => $faker->text(),
            'price' =>  $faker->numberBetween(10,1000)*10000,
            'updated_at' => now(),
            'created_at' => now(),
        ];
    }
}
