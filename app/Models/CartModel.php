<?php


namespace App\Models;

use CodeIgniter\Model;


class CartModel extends Model
{
    protected $table = 'cart';
    protected $primaryKey = 'CartId';  

    protected $useTimestamps = true;

    protected $allowedFields = [
        'user_id',
        'session_id',
        'Prodid',
        'ProdName',
        'ProdImage',
        'price',
        'quantity',
        'is_saved_later',
        'discount_percent',
        'shipping_cost',
        'tax_percent'
    ];
    
}
