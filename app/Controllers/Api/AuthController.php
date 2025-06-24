<?php

// app/Controllers/Api/UserApiController.php
namespace App\Controllers\Api;

use Config\Validation; // (optional, for intellisense)
use App\Models\AuthModels\SignupModel;
use CodeIgniter\RESTful\ResourceController;

class AuthController extends ResourceController
{
    // protected $modelName = SignupModel::class;
    protected $format    = 'json';

    public function signupView()
    {
        return view('signup/signupView');
    }

    // ========================= with Api and Config/Validation.php hai ye ================= 
    public function create()  // POST /api/signupcreate
    {
        $data = $this->request->getJSON(true);

        $rules = (new \Config\Validation())->signup;

        if (! $this->validate($rules, $data)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        // ✅ Save to DB using model
        $model = new SignupModel();
        $model->save($data);

        return $this->respondCreated([
            'message' => 'User data is valid & saved!',
            'data' => $data
        ]);
    }

    // ========================= with Api and Model validatin hai ye ================= 
    // public function create() // POST /api/users
    // {
    //     $model = new SignupModel();
    //     $data = $this->request->getJSON(true); // ✅ Get JSON input as associative array

    //     if (! $model->save($data)) {
    //         // ❗ Return validation errors in JSON
    //         return $this->failValidationErrors($model->errors());
    //     }

    //     // ✅ Return success + created user
    //     return $this->respondCreated([
    //         'status' => 201,
    //         'message' => 'User created successfully',
    //         'user' => $model->find($model->insertID()) // optional
    //     ]);
    // }

    // ================  without api hai =======================
    // public function signup()
    // {
    //     helper(['form']);

    //     if ($this->request->getMethod() === 'post') {
    //         $model = new SignupModel();

    //         // ✅ Model handles validation internally
    //         if ($model->save($this->request->getPost())) {
    //             return redirect()->to('/success');
    //         }

    //         // ✅ Show errors from model
    //         return view('signup_form', [
    //             'validation' => $model->errors()
    //         ]);
    //     }

    //     return view('signup_form');
    // }

    // public function index() // GET /api/category
    // {
    //     return $this->respond($this->model->findAll());
    // }

    // public function create() // POST /api/brand
    // {
    //     $data = $this->request->getJSON(true);
    //     if ($this->model->insert($data)) {
    //         return $this->respondCreated(['message' => 'Brand created successfully']);
    //     }
    //     return $this->failValidationErrors($this->model->errors());
    // }


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

    // public function delete($id = null) // DELETE /api/users/{id}
    // {
    //     if ($this->model->delete($id)) {
    //         return $this->respondDeleted(['message' => 'User deleted']);
    //     }
    //     return $this->failNotFound('User not found');
    // }
}
