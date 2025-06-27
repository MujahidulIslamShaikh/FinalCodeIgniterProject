<?php


namespace App\Models;
use CodeIgniter\Model;

class ProductApiModel extends Model
{
    protected $table = 'productApiTable';
    protected $primaryKey = 'Prodid';

    protected $allowedFields = ['ProdName', 'details', 'CateId', 'BrandId', 'ProdImage'];
}







