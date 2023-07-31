<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CartProductPivotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i=1; $i<=10; $i++)
        {
            DB::table('carts_products_pivot')->insert(
                [
                    'cart_id' => $i,
                    'product_id' => fake()->numberBetween(1, 20)
                ]
            );
        }
    }
}
