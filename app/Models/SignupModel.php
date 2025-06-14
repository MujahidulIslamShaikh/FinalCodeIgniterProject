<?php


namespace App\Models;
use CodeIgniter\Model;

class SignupModel extends Model
{   
    protected $table = 'signup';
    protected $primaryKey = 'id'; 
    protected $allowedFields = ['username', 'email', 'pass', 'reset_token'];
}
