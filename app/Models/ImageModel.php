<?php

// File: app/Models/ImageModel.php

namespace App\Models;

use CodeIgniter\Model;

class ImageModel extends Model
{   
    protected $table      = 'imagemodel';
    protected $primaryKey = 'id';
    protected $allowedFields = ['file_name', 'file_path', 'type', 'ref_id'];
    protected $useTimestamps = true;
}



?>