<?php

// app/Controllers/Api/UserApiController.php
namespace App\Controllers\Api;

use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;

class UserApiController extends ResourceController
{
    protected $modelName = UserModel::class;
    protected $format    = 'json';
    

    public function index() // GET /api/users
    {
        $users = $this->model->findAll();
        return $this->respond($users);
        // return $this->modelName;
        // return $this->respond($this->model->findAll());
    }

    public function show($id = null) // GET /api/users/{id}
    {
        $data = $this->model->find($id);
        return $data ? $this->respond($data) : $this->failNotFound("User not found");
    }

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
