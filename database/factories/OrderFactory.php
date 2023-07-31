<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->numberBetween(1, 10), // an ID of any of the first 10 users
            'total_value' => fake()->numberBetween(10, 1000), // total price between 10 and 1000
            'total_weight' => fake()->numberBetween(1, 20), // total weight between 1 and 10 kg
            'payment_method' => fake()->randomElement(['cash', 'card'])
        ];
    }
}
