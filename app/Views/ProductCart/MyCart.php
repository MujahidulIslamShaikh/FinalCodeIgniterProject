<?= $this->extend('/index') ?>
<?= $this->section('contentIndex') ?>

<div class="container py-5">
    <h2 class="mb-4">🛒 My Cart</h2>
    <div class="table-responsive">
        <table class="table table-bordered align-middle" id="cartTable">
            <thead class="table-dark">
                <tr>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
<script>
    const loadCart = async () => {
        const res = await fetch('/api/getCartItems');
        const items = await res.json();

        const tbody = document.querySelector('#cartTable tbody');
        tbody.innerHTML = items.map(item => `
            <tr>
                <td><img src="${item.ProdImage}" alt="${item.ProdName}" style="height:50px; object-fit:cover;"></td>
                <td>
                    <div class="d-flex justify-content-between">
                        ${item.ProdName}
                        <a href="#" class="text-danger ms-2" onclick="removeCart(${item.CartId}, this); return false;">Remove</a>
                    </div>
                </td>
                <td >₹ ${parseFloat(item.price).toFixed(2)}</td>
                <td>
                    <div class="input-group" style="max-width: 120px;">
                        <button class="btn btn-outline-secondary btn-sm" onclick="adjustQuantity(${item.CartId}, -1, this)">➖</button>
                        <input type="text" class="form-control text-center form-control-sm" value="${item.quantity}" readonly>
                        <button class="btn btn-outline-secondary btn-sm" onclick="adjustQuantity(${item.CartId}, 1, this)">➕</button>
                    </div>
                </td>
                <td>₹ ${(item.price * item.quantity).toFixed(2)}</td>
            </tr>
        `).join('');
    };


    const adjustQuantity = async (cartId, delta, btnElement) => {
        const row = btnElement.closest('tr');
        const input = row.querySelector('input');
        let currentQty = parseInt(input.value);

        const newQty = currentQty + delta;
        if (newQty < 1) return;

        try {
            const res = await fetch(`/api/updateCartQuantity`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    CartId: cartId,
                    quantity: newQty
                })
            });

            if (res.ok) {
                input.value = newQty;

                const priceText = row.querySelector('td:nth-child(3)').innerText.replace(/[^\d.]/g, '');
                const price = parseFloat(priceText);
                const totalCell = row.querySelector('td:nth-child(5)');
                totalCell.innerText = `₹ ${(price * newQty).toFixed(2)}`;
            } else {
                alert('Failed to update quantity');
            }
        } catch (err) {
            console.error('Quantity update failed:', err);
        }
    };


    const removeCart = async (id, el) => {
        if (!confirm("Remove this item?")) return;

        try {
            const res = await fetch(`/api/removeCart/${id}`, {
                method: 'DELETE',
            });

            if (res.ok) {
                // 🧹 Remove the row without reloading
                const row = el.closest('tr');
                row.remove();
            } else {
                const data = await res.json();
                alert("❌ Failed: " + (data.message || 'Unknown error'));
            }
        } catch (err) {
            console.error(err);
            alert("⚠️ Something went wrong.");
        }
    };

    loadCart();
</script>

<?= $this->endSection(); ?>