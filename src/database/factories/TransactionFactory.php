<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'type' => fake()->randomElement(['output', 'input']),
            'amount' => fake()->numberBetween(10, 1000),
            'description' => fake()->sentence(6),
            'date' => fake()->date(),
        ];
    }
}
