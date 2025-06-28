<?php

// File: app/Controllers/Api/ImageUploadController.php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Services\ImageService;   

class ImageUploadController extends ResourceController
{
    public function upload()
    {   
        $file = $this->request->getFile('image');

        $imageService = new ImageService();
        $result = $imageService->upload($file, $this->request->getPost('type') ?? 'productsImage');

        if (!$result['status']) {
            return $this->failValidationErrors(['image' => $result['message']]);
        }

        return $this->respondCreated([
            'message' => 'Image uploaded successfully',
            'image_id' => $result['image_id'],
            'path'     => $result['path']
        ]);
    }
    // public function update() 
    // {
        
    // }
}


?>