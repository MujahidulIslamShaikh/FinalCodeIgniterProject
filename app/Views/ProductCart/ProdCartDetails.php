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


<!--
<style>
    .product-card {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        transition: all 0.2s ease-in-out;
    }

    .product-card:hover {
        transform: scale(1.02);
    }

    .product-image {
        height: 160px;
        object-fit: cover;
    }

    .product-title {
        font-size: 1rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 0.25rem;
    }

    .product-meta {
        font-size: 0.75rem;
        color: #777;
    }

    .product-price {
        font-size: 1rem;
        color: #198754;
        font-weight: bold;
    }

    .product-description {
        font-size: 0.8rem;
        color: #555;
        margin: 0.5rem 0;
    }

    .btn-cart,
    .btn-view {
        font-size: 0.75rem;
        padding: 0.3rem 0.6rem;
    }

    .btn-group {
        display: flex;
        gap: 0.5rem;
    }
</style>

<div class="container py-4">
    <div class="row g-3" id="productContainer"></div>
</div>

<script>
    const loadCards = async () => {
        const res = await fetch(`/api/product/searchByProdNameCateBrand`);
        const prodInfo = await res.json();

        const container = document.getElementById('productContainer');  
        container.innerHTML = prodInfo.map(prod => `
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card product-card h-100">
                    <img src="${prod.ProdImage}" class="card-img-top product-image" alt="${prod.ProdName}">
                    <div class="card-body p-2 d-flex flex-column">
                        <h6 class="product-title">${prod.ProdName}</h6>
                        <div class="product-meta mb-1">${prod.brand} | ${prod.category}</div>
                        <div class="product-description">${prod.details.slice(0, 60)}...</div>
                        <div class="product-price mb-1">₹ ${parseFloat(prod.price).toLocaleString('en-IN', {minimumFractionDigits: 2})}</div>
                        <div class="product-meta text-danger mb-2">Stock: ${prod.stock}</div>
                        <div class="btn-group mt-auto">
                            <a href="DisplayCart/${prod.Prodid}" class="btn btn-outline-primary btn-view w-50">View Details</a>
                            <button class="btn btn-success btn-cart w-50" onclick='addCart(${JSON.stringify(prod)})'>Add Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        `).join('');
    }


    loadCards();
</script> -->
<?php
// echo view('ProductCart/create');
?>


<!-- {
        "Prodid": "53",
        "ProdName": "dsdsadsa",
        "details": "sadsa",
        "CateId": "6",
        "BrandId": "23",
        "ProdImage": "uploads/products/1751207408_ad1ab285064718205a34.jpeg",
        "category": "Keyboard",
        "brand": "Brand 2"
    }, -->