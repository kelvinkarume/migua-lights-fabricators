<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'national_id' => fake()->unique()->numerify('########'),
            'phone' => fake()->unique()->numerify('07########'),
            'gender' => fake()->randomElement(['Male', 'Female']),
            'residence' => fake()->city(),
            'photo' => null,
            'role' => 'user',
            'password' => Hash::make('password123'),
        ];
    }
}