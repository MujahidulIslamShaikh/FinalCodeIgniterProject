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
                        <a href="/api/removeCart/${item.CartId}" class="text-danger ms-2" onclick="return confirm('Remove this item?')">Remove</a>
                    </div>
                </td>
                <td >₹ ${parseFloat(item.price).toFixed(2)}</td>
                <td>${item.quantity}</td>
                <td>₹ ${(item.price * item.quantity).toFixed(2)}</td>
            </tr>
        `).join('');
    };

    loadCart();
</script>

<?= $this->endSection(); ?>