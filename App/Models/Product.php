<?php

namespace App\Models;

class Product extends Model
{
    public static function getAll()
    {
        $products = static::all();
        usort($products, function ($a, $b) {return strcmp((int)$a->product_form, (int)$b->product_form);});
        return $products;
    }
}