<?php


namespace App\Models;
use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'products';            // Table ka naam
    protected $primaryKey = 'id';             // Primary key

    protected $allowedFields = ['name', 'image'];  // Insert/update ke liye allowed fields

    // Agar automatic timestamps chahiye to uncomment karein:
    // protected $useTimestamps = true;
}
