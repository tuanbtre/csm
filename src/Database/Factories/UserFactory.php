<?php

namespace Tuanbtre\Csm\Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
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
        return [
            'name' => 'Administrator',
            'username' => 'administrator',
            'image' => 'Sw1zizEJsdJofVCDuP8ZHuQ5gQFHy0OanLjrzf58.jpg',
            'phone' => '091810000',
            'address' => '103 pasteur p Bến Nghé Q1 TPHCM',
            'email' => 'tuancsharp@gmail.com',
            'email_verified_at' => now(),
			'isactive' =>1,
            'password' => '$2y$10$TJixClYfJ33iz/Fnf/No/ew.rRknMXOVQyuA64T3xHFmeWrMk/fAq', // password
            'remember_token' => Str::random(10),
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
