<?php

namespace App\Controllers;

use App\Models\Product;

class ProductListController
{
    public function index()
    {
        return view('ProductList');
    }

    public function DeleteProducts()
    {
        if(request()->all() == null)
        {
            return view('ProductList');
        }
        Product::deleteIn('product_form', array_key_exists("selected_products", request()->all()) ? request()->all()['selected_products'] : []);
        return view('ProductList');
    }
}