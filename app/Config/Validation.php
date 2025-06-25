<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var list<string>
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    public array $signup = [
        'username' => [
            'label' => 'Username',
            'rules' => 'required|min_length[3]|is_unique[SignupModel.username]',
            'errors' => [
                'required'   => 'Username is required.',
                'min_length' => 'Username must be at least 3 characters.',
                'is_unique'   => 'Username already taken , please use different username.'
            ]
        ],
        'email' => [
            'label' => 'Email',
            'rules' => 'required|valid_email|is_unique[SignupModel.email]',
            'errors' => [
                'required'    => 'Email is required.',
                'valid_email' => 'Enter a valid email.',
                'is_unique'   => 'Email already registered.'
            ]
        ],
        'password' => [
            'label' => 'Password',
            'rules' => 'required|min_length[6]',
            'errors' => [
                'required'   => 'Password is required.',
                'min_length' => 'Minimum 6 characters required.'
            ]
        ]
    ];

    public array $product = [
    'ProdName' => [
        'label' => 'Product Name',
        'rules' => 'required|min_length[2]|max_length[100]',
        'errors' => [
            'required'   => 'Product name is required.',
            'min_length' => 'At least 2 characters required.',
            'max_length' => 'Cannot exceed 100 characters.'
        ]
    ],
    'details' => [
        'label' => 'Product Details',
        'rules' => 'required|min_length[5]|max_length[255]',
        'errors' => [
            'required'   => 'Product details are required.',
            'min_length' => 'Minimum 5 characters needed.',
            'max_length' => 'Maximum 255 characters allowed.'
        ]
    ],
    'CateId' => [
        'label' => 'Category',
        'rules' => 'required|integer|is_not_unique[category.CateId]',
        'errors' => [
            'required'      => 'Category must be selected.',
            'integer'       => 'Invalid category ID.',
            'is_not_unique' => 'Category does not exist.'
        ]
    ],
    'BrandId' => [
        'label' => 'Brand',
        'rules' => 'required|integer|is_not_unique[brand.BrandId]',
        'errors' => [
            'required'      => 'Brand must be selected.',
            'integer'       => 'Invalid brand ID.',
            'is_not_unique' => 'Brand does not exist.'
        ]
    ],
];



    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------
}
