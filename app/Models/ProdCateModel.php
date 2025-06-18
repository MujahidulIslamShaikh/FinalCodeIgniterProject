<?php

// app/Models/CategoryModel.php
namespace App\Models;
use CodeIgniter\Model;

class ProdCateModel extends Model
{
    protected $table = 'product_categories';
    protected $primaryKey = 'CateId';
    protected $allowedFields = ['CateName'];

        // ✅ Validation rules to prevent duplicate CateName
    protected $validationRules = [
        'CateName' => 'required|is_unique[product_categories.CateName]'
    ];

    protected $validationMessages = [
        'CateName' => [
            'required' => 'Category name is required',
            'is_unique' => 'This category already exists'
        ]
    ];

    
}




