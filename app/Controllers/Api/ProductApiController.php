<?php

// app/Controllers/Api/UserApiController.php
namespace App\Controllers\Api;

use App\Models\ProdCateModel;
use App\Models\ProductApiModel;
use CodeIgniter\RESTful\ResourceController;

class ProductApiController extends ResourceController
{
    protected $modelName = ProductApiModel::class;
    protected $format    = 'json';
    protected $model;
    protected $cateModel;

    public function __construct()
    {
        $this->model = new ProductApiModel();
        $this->cateModel = new ProdCateModel();
    }

    public function productView()
    {
        return view('/ProductListApiView');
    }
    public function FilterProductView()
    {
        $data['categories'] = $this->cateModel->findAll();
        return view('/FilterProductListApiView', $data);
    }
    public function FilterProdByCate()
    {
        $categoryId = $this->request->getGet('category');

        $builder = $this->model
            ->select('productapitable.*, product_categories.CateName as category, product_brands.BrandName as brand')
            ->join('product_categories', 'product_categories.CateId = productapitable.CateId')
            ->join('product_brands', 'product_brands.BrandId = productapitable.BrandId');

        if (!empty($categoryId)) {
            $builder->where('productapitable.CateId', $categoryId);
        }   

        return $this->respond($builder->findAll());
    }


    public function index() // GET /api/product 
    {
        // $products = $this->model->findAll(); 
        $products = $this->model
            ->select('productapitable.*, product_categories.CateName as category, product_brands.BrandName as brand')
            ->join('product_categories', 'product_categories.CateId = productapitable.CateId')
            ->join('product_brands', 'product_brands.BrandId = productapitable.BrandId')
            ->findAll();
        return $this->respond($products);
    }

    // public function show($id = null) // GET /api/users/{id}
    // {
    //     $data = $this->model->find($id);
    //     return $data ? $this->respond($data) : $this->failNotFound("User not found");
    // }

    public function create() // POST /api/users
    {
        $data = $this->request->getJSON(true);
        if ($this->model->insert($data)) {
            return $this->respondCreated(['message' => 'User created successfully']);
        }
        return $this->failValidationErrors($this->model->errors());
    }

    // public function update($id = null) // PUT /api/users/{id}
    // {
    //     $data = $this->request->getJSON(true);
    //     if ($this->model->update($id, $data)) {
    //         return $this->respond(['message' => 'User updated successfully']);
    //     }
    //     return $this->failValidationErrors($this->model->errors());
    // }

    // public function delete($id = null) // DELETE /api/users/{id}
    // {
    //     if ($this->model->delete($id)) {
    //         return $this->respondDeleted(['message' => 'User deleted']);
    //     }
    //     return $this->failNotFound('User not found');
    // }


}
