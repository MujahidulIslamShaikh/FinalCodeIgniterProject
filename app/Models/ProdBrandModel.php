<?php

// app/Models/CategoryModel.php
namespace App\Models;
use CodeIgniter\Model;

class ProdBrandModel extends Model
{
    protected $table = 'product_brands';
    protected $primaryKey = 'BrandId';
    protected $allowedFields = ['BrandName'];

        // ✅ Validation rules to prevent duplicate CateName
    protected $validationRules = [
        'BrandName' => 'required|is_unique[product_categories.CateName]'
    ];

    protected $validationMessages = [
        'BrandName' => [
            'required' => 'Brand name is required',
            'is_unique' => 'This brand already exists'
        ]
    ];

    
}




