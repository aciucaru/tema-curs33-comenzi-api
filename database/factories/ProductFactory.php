<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    // protected $model = Product::class;


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $productNames = [
                            'Smartphone',
                            'OLED Screen',
                            'TV',
                            'Tablet',
                            'Keyboard',
                            'Mouse',
                            'BluRay Player',
                            'Soundbar',
                            'D-SLR Camera',
                            'Notebook'
                        ];

        return [
            'name' => fake()->randomElement($productNames),
            'price' => fake()->numberBetween(10, 1000), // price between 10 and 1000
            'weight' => fake()->numberBetween(1, 5), // weight between 1 and 5 kg
            'color' => fake()->safeColorName()
        ];
    }
}
