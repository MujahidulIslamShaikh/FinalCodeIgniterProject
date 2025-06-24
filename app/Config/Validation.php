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
                'min_length' => 'Username must be at least 3 characters.'
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
