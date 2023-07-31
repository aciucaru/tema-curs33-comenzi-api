<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('carts_products_pivot', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')
                    ->references('id')->on('carts')
                    ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('product_id')
                    ->references('id')->on('products')
                    ->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts_products_pivot');
    }
};
