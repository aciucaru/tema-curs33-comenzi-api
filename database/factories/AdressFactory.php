<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Adress>
 */
class AdressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $countyAndCityPairs = [
            ['county' => 'Arad', 'city' => 'Arad'],
            ['county' => 'Alba', 'city' => 'Alba Iulia'],
            ['county' => 'Bihor', 'city' => 'Oradea'],
            ['county' => 'Brasov', 'city' => 'Brasov'],
            ['county' => 'Cluj', 'city' => 'Cluj-Napoca'],
            ['county' => 'Dolj', 'city' => 'Craiova'],
            ['county' => 'Galati', 'city' => 'Galati'],
            ['county' => 'Iasi', 'city' => 'Iasi'],
            ['county' => 'Mures', 'city' => 'Targu Mures'],
            ['county' => 'Vrancea', 'city' => 'Focsani'],
        ];

        return [
            'order_id' => fake()->numberBetween(1, 20), // an ID of any of the first 20 orders
            'text' => fake()->sentence(),
            'city' => fake()->randomElement( array_map(fn($pair) => $pair['city'], $countyAndCityPairs) ),
            'county' => fake()->randomElement( array_map(fn($pair) => $pair['county'], $countyAndCityPairs) )
        ];
    }
}
