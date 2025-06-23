<?php 

namespace App\Models\AuthModels;

use CodeIgniter\Model;

class SignupModel extends Model
{
    protected $table      = 'SignupModel';
    protected $primaryKey = 'id';

    protected $allowedFields = ['username', 'email', 'password'];

    // ✅ Model-level Validation Rules
    protected $validationRules = [
        'username' => 'required|min_length[3]|max_length[30]',
        'email'    => 'required|valid_email|is_unique[users.email]',
        'password' => 'required|min_length[6]'
    ];

    // ✅ Custom error messages
    protected $validationMessages = [
        'username' => [
            'required' => 'Username is required.',
            'min_length' => 'Username must be at least 3 characters.',
        ],
        'email' => [
            'required' => 'Email is required.',
            'valid_email' => 'Enter a valid email.',
            'is_unique' => 'Email already registered.'
        ],
        'password' => [
            'required' => 'Password is required.',
            'min_length' => 'Password must be at least 6 characters.',
        ]
    ];
}
