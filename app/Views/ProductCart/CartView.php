<?= $this->extend('/index') ?>
<?= $this->section('contentIndex') ?>

<div class="container py-5">
    <h2 class="mb-4">Cart</h2>
    <div class="row justify-content-center">
        <div class="col-md-8" id="cartProductContainer">
            <!-- Product detail will be injected here -->
        </div>
    </div>
</div>

<script>
    const prodId = <?= json_encode($Prodid) ?>;
    console.log(prodId);
    const api = `/api/product/${prodId}`;
    const loadProductInfo = async () => {

        try {
            const res = await fetch(api);
            // console.log(res);
            const prod = await res.json();
            console.log(prod);
            const container = document.getElementById('cartProductContainer');
            container.innerHTML = `
                <div class="card shadow-lg">
                    <div class="row g-0">
                        <div class="col-md-5">
                        <img src="/${prod.ProdImage}" 
                            class="img-fluid rounded-start" 
                            alt="${prod.ProdName}" 
                            onerror="this.src='/assets/no-image.png'">
                        </div>
                        <div class="col-md-7">
                            <div class="card-body d-flex flex-column h-100">
                                <h3 class="card-title">${prod.ProdName}</h3>
                                <p class="card-text">${prod.details}</p>
                                <ul class="list-group list-group-flush mb-3">
                                    <li class="list-group-item"><strong>Category:</strong> ${prod.category}</li>
                                    <li class="list-group-item"><strong>Brand:</strong> ${prod.brand}</li>
                                    <li class="list-group-item text-success fs-5">
                                        <strong>Price:</strong> <span class="text-dark">₹ ${parseFloat(prod.price).toLocaleString('en-IN', {minimumFractionDigits: 2})}</span>
                                    </li>
                                    <li class="list-group-item text-danger"><strong>Stock:</strong> ${prod.stock}</li>
                                </ul>
                                <div class="mt-auto">
                                    <button class="btn btn-success w-100">✅ Confirm Add to Cart</button>
                            <button onclick='openProductEditModal(${JSON.stringify(prod)})' class="btn btn-sm btn-outline-warning">Edit</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        } catch (error) {
            console.error("Failed to load product info:", error);
        }
    }

    loadProductInfo();

</script>

<?= $this->endSection() ?>