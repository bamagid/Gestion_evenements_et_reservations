<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class ClientFactory extends Factory
{

    public function definition(): array
    {
        return [
            'Nom'=> fake()->name(),
            'Prenom'=>fake()->name(),
            'telephone'=>fake()->randomNumber(8),
            'email' => fake()->unique()->safeEmail(),
            // 'email_verified_at' => now(),
            'password' =>Hash::make('azerty12'),
            'remember_token' => Str::random(10),
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
