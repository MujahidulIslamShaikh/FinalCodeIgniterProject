<?php

// app/Controllers/Api/UserApiController.php
namespace App\Controllers\Api;

use App\Models\AuthModels\SignupModel;
use CodeIgniter\RESTful\ResourceController;

class AuthController extends ResourceController
{
    protected $modelName = SignupModel::class;
    protected $format    = 'json';
    protected $model;
    
    public function __construct()
    {
        $this->model = new SignupModel();
    }

    public function signupView(){
        return view('signup/signupView');
    }

    public function index() // GET /api/category
    {
        return $this->respond($this->model->findAll());
    }

    public function create() // POST /api/brand
    {
        $data = $this->request->getJSON(true);
        if ($this->model->insert($data)) {
            return $this->respondCreated(['message' => 'Brand created successfully']);
        }
        return $this->failValidationErrors($this->model->errors());
    }


    // public function show($id = null) // GET /api/users/{id}
    // {
    //     $data = $this->model->find($id);
    //     return $data ? $this->respond($data) : $this->failNotFound("User not found");
    // }

    
    // public function update($id = null) // PUT /api/users/{id}
    // {
    //     $data = $this->request->getJSON(true);
    //     if ($this->model->update($id, $data)) {
    //         return $this->respond(['message' => 'User updated successfully']);
    //     }
    //     return $this->failValidationErrors($this->model->errors());
    // }

    public function delete($id = null) // DELETE /api/users/{id}
    {
        if ($this->model->delete($id)) {
            return $this->respondDeleted(['message' => 'User deleted']);
        }
        return $this->failNotFound('User not found');
    }


}
