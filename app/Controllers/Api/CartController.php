<?php

// app/Controllers/Api/UserApiController.php
namespace App\Controllers\Api;

use Config\Validation; // (optional, for intellisense)
use App\Models\AuthModels\SignupModel;
use App\Models\CartModel;
use CodeIgniter\RESTful\ResourceController;

class CartController extends ResourceController
{
    // protected $modelName = SignupModel::class;
    protected $format    = 'json';

    public function ProdCartDetails()
    {
        return view('ProductCart/ProdCartDetails');
        // return 'cart controller method success';
    }

    // ========================= with Api and Config/Validation.php hai ye ================= 
    public function cartCreate()
    {
        $data = $this->request->getJSON(true);
        $cartModel = new \App\Models\CartModel();

        // ✅ Use Prodid for safe matching
        $existing = $cartModel->where('Prodid', $data['Prodid'])->first();

        if ($existing) {
            // ✅ Increase quantity if already exists
            $cartModel->update($existing['CartId'], [
                'quantity' => $existing['quantity'] + 1
            ]);

            return $this->respond(['message' => 'Quantity updated in cart']);
        } else {
            // ✅ Add new entry
            $cartModel->insert($data);
            return $this->respondCreated(['message' => 'Product added to cart']);
        }
    }

    // In CartApiController.php
    public function MyCart()
    {
        return view('/ProductCart/MyCart');
    }
    public function getCartItems()
    {
        $model = new CartModel();
        $cartItems = $model->findAll();

        return $this->respond($cartItems);
    }
    // ================ updateCartQuantity ==========================
    public function updateCartQuantity()
    {
        $data = $this->request->getJSON(true);
        $cartId = $data['CartId'] ?? null;
        $quantity = $data['quantity'] ?? null;

        if (!$cartId || !$quantity || $quantity < 1) {
            return $this->fail('Invalid input', 400);
        }

        $model = new \App\Models\CartModel(); // update with your actual model name
        $updated = $model->update($cartId, ['quantity' => $quantity]);

        if ($updated) {
            return $this->respond(['status' => 'success']);
        } else {
            return $this->failServerError('Update failed');
        }
    }

    // public function cartCreate()  // POST /api/CartView
    // {
    //     $data = $this->request->getJSON(true);
    //     $cartModel = new CartModel();

    //     $existing = $cartModel->where('Prodid', $data['Prodid'])->first();

    //     return $this->response->setJSON([
    //     'message' => $existing ? 'Product already in cart' : 'No match found',
    //     'existing_product' => $existing
    // ]);

    // // ✅ Save to DB using model
    // $model = new CartModel();
    // $model->save($data);

    // return $this->respondCreated([
    //     'message' => 'Cart data saved!',
    //     'data' => $data
    // ]);
    // }

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

    // public function removeCart($id = null) // DELETE /api/removeCart/{id}
    // {
    //     $model = new CartModel();
    //     $model->delete($id);
    //     return redirect()->to('/MyCart');
    // }
    public function removeCart($id = null) // DELETE /api/removeCart/{id}
    {
        $model = new CartModel();
        if ($model->delete($id)) {
            return $this->respondDeleted(['message' => 'Cart item removed']);
        }
        return $this->failNotFound('Cart item not found');
    }
}
