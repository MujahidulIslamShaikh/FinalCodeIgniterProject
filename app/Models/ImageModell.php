<?php

namespace App\Models;
use CodeIgniter\Model;

class ImageModel extends Model
{
    protected $table = 'images';
    protected $allowedFields = ['imgName', 'image_name'];
}
