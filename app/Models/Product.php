<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'name',
        'price',
        'weight',
        'color'
    ];

    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'carts_products_pivot');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'orders_products_pivot');
    }
}