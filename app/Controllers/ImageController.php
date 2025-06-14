<?php



namespace App\Controllers;

use App\Models\ImageModel;

class ImageController extends BaseController
{

    public function upload()
    {
        return view('/admin/UplMultImgView');
    }
    
    public function doupload()
    {
        $files = $this->request->getFiles();
        $imgName = $this->request->getPost();
        $model = new ImageModel();
            
        if ($files && isset($files['images'])) {
            foreach ($files['images'] as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move('uploads/', $newName);
                    $model->insert([
                        'image_name' => $newName,
                        'imgName' => $imgName,
                    ]);
                }
            }
        }

        return redirect()->to('/admin/mult-image-upload');
    }
}
