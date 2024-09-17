<?php

namespace App\Controllers;

use App\Models\Product;
use Mali\Validation\Validator;
use View\products\contract\ProductUI;


class AddProductController
{
    public function index()
    {
        return view('AddProduct');
    }

    protected function RetRequestFromUi(ProductUI $reqType)
    {
        return $reqType->getFormula();
    }


    public function store()
    {
        // Validate
        $v = new Validator();
        $data = request()->all();
        
        // Get type class
        $classType = 'View\\products\\' . $data['type'];
        $classType = new $classType();
        
        $rules = [
            'sku'    => 'required|alnum|unique:products,sku',
            'name'   => 'required|alpha',
            'price'  => 'required|numeric',
            'type'   => 'required',
        ];

        for($i = 0; $i < count($classType->getTypeAttributes()); $i++)
        {
            $rules[$classType->getTypeAttributes()[$i]] = 'required|numeric';
        }

        $v->setRules($rules);

        $v->make(request()->all());
        
        // redirect back with errors
        if(!$v->passes())
        {
            app()->session->setFlash('errors', $v->errors());
            app()->session->setFlash('old', request()->all());
            return back();
        }

        // Create product
        Product::create([
            'sku' => request('sku'),
            'name' => request('name'),
            'price' => request('price'),
            'type' => request('type'),
            'attribute' => $this->RetRequestFromUi($classType)
        ]);
        

        // reddirect back with success message
        app()->session->setFlash('sucess', 'Stored successfully!');

        return header("Location: /");
    }
}
