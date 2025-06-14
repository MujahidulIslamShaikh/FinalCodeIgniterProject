<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel;

class UploadController extends BaseController
{
    public function uploadMethod()
    {
        return view('/admin/uploadView');
    }
    public function saveFileMethod()
    {
        $productModel = new ProductModel();

        $file = $this->request->getFile('image');
        $newName = $file->getRandomName();

        // echo "<pre>"; print_r($file) ; exit;

        // File move to public/uploads/
        if ($file->isValid() && !$file->hasMoved()) {
            $file->move(FCPATH . 'uploads', $newName);
        }
        $data = [
            'name'  => $this->request->getPost('name'),
            'image' => $newName,
        ];

        // Save name & image in DB
        $productModel->insert($data);

        return redirect()->to('/display-file');
        // return $newName;
        return view('/uploadView');
    }

    public function ShowFileDataMethod()
    {
        $model = new ProductModel();
        $data['products'] = $model->findAll();
        return view('/displayFileView', $data);
    }

    public function ProductActions()
    {
        $model = new ProductModel();
        $data['products'] = $model->findAll();

        return view('/admin/ProductActions', $data);
    }

    public function DeleteProduct($id)
    {
        $model = new ProductModel();
        $user = $model->find($id);

        if ($user) {
            // Delete image file from uploads/
            $imagePath = FCPATH . 'uploads/' . $user['image'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            // Delete from database
            $model->delete($id);
        }

        return redirect()->to('/admin/ProductActions');
        // return $id;
    }
    public function EditProduct($id)
    {
        $model = new ProductModel();
        $data['product'] = $model->find($id);
        return view('/admin/editProduct', $data);
    }
    public function UpdateProduct($id)
    {
        $model = new ProductModel();
        $user = $model->find($id);

        $data = ['name' => $this->request->getPost('name')];

        $file = $this->request->getFile('image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/', $newName);

            // delete old file
            if (file_exists(FCPATH . 'uploads/' . $user['image'])) {
                unlink(FCPATH . 'uploads/' . $user['image']);
            }

            $data['image'] = $newName;
        }

        $model->update($id, $data);
        return redirect()->to('/admin/ProductActions');
    }
}
