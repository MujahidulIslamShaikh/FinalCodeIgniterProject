<?php

// app/Controllers/Api/UserApiController.php
namespace App\Controllers\Api;

use App\Models\ProdCateModel;
use App\Models\ProductApiModel;
use CodeIgniter\RESTful\ResourceController;
use PhpParser\Node\Expr\FuncCall;

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
    public function CreateProductView()
    {
        return view('/CreateProductView');
    }
    public function ProdCardDisplayList()
    {
        return view('product/ProdCardDisplayList');
    }
    public function CreateNewProduct()
    {
        return view('product/CreateNewProduct');
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
    public function ProductTest()
    {
        $data = $this->model->findAll();
        return $this->respond($data);
    }


    public function FilterProdByCate()   // important ======================
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


    public function FilterProdByBrand()   // important =======================
    {
        $brandId = $this->request->getGet('prodBrand');

        $builder = $this->model
            ->select('productapitable.*, product_categories.CateName as category, product_brands.BrandName as brand')
            ->join('product_categories', 'product_categories.CateId = productapitable.CateId')
            ->join('product_brands', 'product_brands.BrandId = productapitable.BrandId');

        if (!empty($brandId)) {
            $builder->where('productapitable.BrandId', $brandId);
        }
        return $this->respond($builder->findAll());
    }
    public function searchByProductName()    // important ==========================================
    {
        $searchTerm = $this->request->getGet('search');

        $builder = $this->model
            ->select('productapitable.*, product_categories.CateName as category, product_brands.BrandName as brand')
            ->join('product_categories', 'product_categories.CateId = productapitable.CateId')
            ->join('product_brands', 'product_brands.BrandId = productapitable.BrandId');

        if (!empty($searchTerm)) {
            $builder->like('productapitable.ProdName', $searchTerm);
        }

        return $this->respond($builder->findAll());
    }
    public function searchByProdNameCateBrand()
    {
        $searchTerm = $this->request->getGet('search');

        $builder = $this->model
            ->select('
            productapitable.*,
            product_categories.CateName as category,
            product_brands.BrandName as brand
        ')
            ->join('product_categories', 'product_categories.CateId = productapitable.CateId')
            ->join('product_brands', 'product_brands.BrandId = productapitable.BrandId');

        if (!empty($searchTerm)) {
            $builder->groupStart()
                ->like('productapitable.ProdName', $searchTerm)
                ->orLike('product_categories.CateName', $searchTerm)
                ->orLike('product_brands.BrandName', $searchTerm)
                ->groupEnd();
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

    public function SearchFilterProdCate()
    {
        // $products = $this->model->findAll();
        // $products = $this->model
        //     ->select('productapitable.*, product_categories.CateName as category, product_brands.BrandName as brand')
        //     ->join('product_categories', 'product_categories.CateId = productapitable.CateId')
        //     ->join('product_brands', 'product_brands.BrandId

        // return $this->respond($products);
    }


    // public function show($id = null) // GET /api/users/{id}
    // {
    //     $data = $this->model->find($id);
    //     return $data ? $this->respond($data) : $this->failNotFound("User not found");
    // }

    // public function create() // POST /api/users
    // {
    //     $data = $this->request->getJSON(true);

    //     if ($this->model->insert($data)) {
    //         return $this->respondCreated(['message' => 'User created successfully']);
    //     }
    //     return $this->failValidationErrors($this->model->errors());
    // }

    // ===================== With Image =============================

    public function create()
    {
        $data = $this->request->getPost(); // get text fields

        // ✅ Handle file upload
        $image = $this->request->getFile('ProdImage');
        if ($image && $image->isValid() && !$image->hasMoved()) {
            $newName = $image->getRandomName();
            $image->move(FCPATH . 'uploads/products/', $newName);
            $data['ProdImage'] = 'uploads/products/' . $newName;
        }

        // ✅ Validate
        if (! $this->validateData($data, 'product')) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        // ✅ Insert into DB
        if ($this->model->insert($data)) {
            return $this->respondCreated(['message' => 'Product created successfully']);
        }

        return $this->failServerError('Insert failed');
    }

    public function update($id = null)
    {
        // Get text input
        $data = $this->request->getPost();

        // ✅ Handle file upload
        $image = $this->request->getFile('ProdImage');
        if ($image && $image->isValid() && !$image->hasMoved()) {
            $newName = $image->getRandomName();
            $uploadPath = FCPATH . 'uploads/products/';

            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true); // Create dir if not exists
            }

            $image->move($uploadPath, $newName);
            $data['ProdImage'] = 'uploads/products/' . $newName;
        }

        // ✅ Update in DB
        if ($this->model->update($id, $data)) {
            return $this->respond([
                'message' => 'Product updated successfully',
                'data' => $data
            ]);
        }

        return $this->failValidationErrors($this->model->errors());
    }



    public function delete($id = null) // DELETE /api/product/{id}
    {
        if ($this->model->delete($id)) {
            return $this->respondDeleted(['message' => 'User deleted']);
        }
        return $this->failNotFound('User not found');
    }
    public function searchFilterProductsByCategory()
    {
        $search = $this->request->getGet('search');

        $result = $this->model
            ->like('CateName', $search)
            ->findAll();

        return $this->respond($result);
    }
    // public function FilterProdByCate()
    // {
    //     $categoryId = $this->request->getGet('category');
    //     $search     = $this->request->getGet('search');

    //     $builder = $this->model
    //         ->select('productapitable.*, product_categories.CateName as category, product_brands.BrandName as brand')
    //         ->join('product_categories', 'product_categories.CateId = productapitable.CateId')
    //         ->join('product_brands', 'product_brands.BrandId = productapitable.BrandId');

    //     if (!empty($categoryId)) {
    //         $builder->where('productapitable.CateId', $categoryId);
    //     }

    //     if (!empty($search)) {
    //         $builder->groupStart()
    //             ->like('productapitable.ProdName', $search)
    //             ->orLike('productapitable.details', $search)
    //             ->groupEnd();
    //     }

    //     return $this->respond($builder->findAll());
    // }

    //////////////  aisa ek sath bhi bana sakte ////////////////////
    //     public function FilterProdByCate()
    // {
    //     $categoryId = $this->request->getGet('category');
    //     $searchTerm = $this->request->getGet('search');

    //     $builder = $this->model
    //         ->select('productapitable.*, product_categories.CateName as category, product_brands.BrandName as brand')
    //         ->join('product_categories', 'product_categories.CateId = productapitable.CateId')
    //         ->join('product_brands', 'product_brands.BrandId = productapitable.BrandId');

    //     if (!empty($categoryId)) {
    //         $builder->where('productapitable.CateId', $categoryId);
    //     }

    //     if (!empty($searchTerm)) {
    //         $builder->like('productapitable.ProdName', $searchTerm);
    //     }

    //     return $this->respond($builder->findAll());
    // }


}


// public function searchByProdNameCateBrand()
// {
    //     $searchTerm = $this->request->getGet('search');
    
    //     $builder = $this->model
    //         ->select('
    //         productapitable.*,
    //         product_categories.CateName as category,
    //         product_brands.BrandName as brand,
    //         imagemodel.file_name,
    //         imagemodel.file_path
    //     ')
    //         ->join('product_categories', 'product_categories.CateId = productapitable.CateId')
    //         ->join('product_brands', 'product_brands.BrandId = productapitable.BrandId')
    //         ->join('imagemodel', 'imagemodel.id = productapitable.ImageId', 'left');

    //     if (!empty($searchTerm)) {
        //         $builder->groupStart()
    //             ->like('productapitable.ProdName', $searchTerm)
    //             ->orLike('product_categories.CateName', $searchTerm)
    //             ->orLike('product_brands.BrandName', $searchTerm)
    //             ->groupEnd();
    //     }
    
    //     return $this->respond($builder->findAll());
    // }
    
    // public function update($id = null) // PUT /api/product/{id} ==================== imp ====================
    // {
    //     // $data = $this->request->getJSON(true);
    //     $data = $this->request->getPost(); // get text fields
    
    //     // ✅ Handle file upload
    //     $image = $this->request->getFile('ProdImage');
    //     if ($image && $image->isValid() && !$image->hasMoved()) {
    //         $newName = $image->getRandomName();
    //         $image->move(FCPATH . 'uploads/products/', $newName);
    //         $data['ProdImage'] = 'uploads/products/' . $newName;
    //     }
    //     if ($this->model->update($id, $data)) {
    //         return $this->respond(['message' => 'User updated successfully']);
    //     }
     
    //     return $this->failValidationErrors($this->model->errors());
    // }