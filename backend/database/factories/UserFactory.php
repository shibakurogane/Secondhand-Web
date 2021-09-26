<?php

namespace Database\Factories;
use Faker\Factory as facker;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = facker::create('vi_VN');

        return [
            'name' => $faker->name(),
            'email' => $faker->unique()->safeEmail(),
            'password' => Hash::make('12345678'),
            'phone' =>0 . $faker->numberBetween(100000000,999999999),
            'remember_token' => Str::random(10),
            'updated_at' => now(),
            'created_at' => now(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
