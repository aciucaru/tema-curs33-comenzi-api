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
        // populate 10 carts
        for($i=1; $i<=10; $i++)
        {
            $productsPerCart = 5;

            // populate 5 products for each cart
            for($j=0; $j<$productsPerCart; $j++)
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
}
