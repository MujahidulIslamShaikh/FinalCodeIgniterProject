<?= $this->extend('/index') ?>
<?= $this->section('contentIndex') ?>

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
                            <a href="DisplayProdCardDetails/${prod.Prodid}" class="btn btn-outline-primary btn-view w-50">View Details</a>
                            <button class="btn btn-success btn-cart w-50" onclick='addCart(${JSON.stringify(prod)})'>Add Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        `).join('');
    }


    loadCards();
</script>
<?php
echo view('ProductCart/create');
?>

<?= $this->endSection() ?>

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