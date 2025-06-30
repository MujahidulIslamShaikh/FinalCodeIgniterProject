
<script>
    // function addcart() 
    // {

    // }
    document.getElementById('signupForm').addEventListener('submit', async function(e) {
        e.preventDefault();

        // Clear old errors
        ['username', 'email', 'password'].forEach(field => {
            document.getElementById('error-' + field).textContent = '';
        });

        const form = e.target;
        const formData = new FormData(form);  
        const payload = Object.fromEntries(formData.entries());

        const res = await fetch('/api/cartCreate', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(payload)
        });

        const result = await res.json();

        if (res.ok) {
            alert(result.message); // or success alert box
            form.reset();
        } else {
            const errors = result.messages;
            for (const field in errors) {
                if (document.getElementById('error-' + field)) {
                    document.getElementById('error-' + field).textContent = errors[field];
                }
            }
        }
    });
</script>




<?php

// namespace App\Models;
// use CodeIgniter\Model;

// class CartModel extends Model
// {
//     protected $table = 'cart';
//     protected $primaryKey = 'CartId';

//     protected $useTimestamps = true;

//     protected $allowedFields = [
//         'user_id',
//         'session_id',
//         'Prodid',
//         'ProdName',
//         'ProdImage',
//         'price',
//         'quantity',
//         'is_saved_later',
//         'discount_percent',
//         'shipping_cost',
//         'tax_percent'
//     ];
// }

// Sample Checkout-ready Table
/*
CREATE TABLE cart (
    CartId INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    session_id VARCHAR(255),
    Prodid INT NOT NULL,
    ProdName VARCHAR(255),
    ProdImage VARCHAR(255),
    price DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    quantity INT NOT NULL DEFAULT 1,
    discount_percent DECIMAL(5,2) DEFAULT 0.00,
    shipping_cost DECIMAL(10,2) DEFAULT 0.00,
    tax_percent DECIMAL(5,2) DEFAULT 0.00,
    is_saved_later BOOLEAN DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    totalAmount DECIMAL(10,2) GENERATED ALWAYS AS (price * quantity) STORED
);
*/

// Sample Insert Controller Logic
/*
public function addToCart()
{
    $cartModel = new \App\Models\CartModel();

    $session = session();
    $userId = $session->get('user_id');
    $sessionId = $session->getId();

    $product = [
        'Prodid' => 30,
        'ProdName' => 'ad omnis',
        'ProdImage' => 'uploads/products/sample.jpg',
        'price' => 150.00
    ];

    $quantity = 2;
    $existing = $cartModel->where(['user_id' => $userId, 'Prodid' => $product['Prodid']])->first();

    if ($existing) {
        $cartModel->update($existing['CartId'], [
            'quantity' => $existing['quantity'] + $quantity
        ]);
    } else {
        $cartModel->insert([
            'user_id' => $userId ?? 0,
            'session_id' => $sessionId,
            'Prodid' => $product['Prodid'],
            'ProdName' => $product['ProdName'],
            'ProdImage' => $product['ProdImage'],
            'price' => $product['price'],
            'quantity' => $quantity,
            'discount_percent' => 10.0,
            'shipping_cost' => 40.00,
            'tax_percent' => 18.0
        ]);
    }

    return $this->respond(['message' => 'Added to cart successfully']);
}
*/
