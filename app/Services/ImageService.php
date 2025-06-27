<?php
// File: app/Services/ImageService.php

namespace App\Services;

use App\Models\ImageModel;

class ImageService
{
    protected $uploadPath = FCPATH . 'uploads/';

    public function upload($file, $type = 'productsImage', $refId = null)   
    {
        if (!$file || !$file->isValid()) {
            return ['status' => false, 'message' => 'Invalid file'];
        }

        $fileName = $file->getRandomName();
        $subDir = $this->uploadPath . $type . '/';

        if (!is_dir($subDir)) {
            mkdir($subDir, 0777, true);
        }

        $file->move($subDir, $fileName);

        $model = new ImageModel();
        $imageData = [
            'file_name' => $fileName,
            'file_path' => 'uploads/' . $type . '/' . $fileName,
            'type'      => $type,
            'ref_id'    => $refId,
        ];

        $model->insert($imageData);
        $imageId = $model->getInsertID();

        return ['status' => true, 'image_id' => $imageId, 'path' => $imageData['file_path']];
    }
}
