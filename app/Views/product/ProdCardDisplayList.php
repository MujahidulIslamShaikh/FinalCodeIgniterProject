<?= $this->extend('/index') ?>
<?= $this->section('contentIndex') ?>

<style>
    .product-card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
    }

    .product-image {
        height: 200px;
        object-fit: cover;
    }

    .product-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #343a40;
    }

    .product-text {
        font-size: 0.95rem;
        color: #6c757d;
    }

    .product-tags {
        font-size: 0.85rem;
        font-weight: 500;
        color: #495057;
    }

    .card-link:hover {
        text-decoration: underline;
    }
</style>

<div class="container py-5">
    <div class="row g-4" id="productContainer">
        <!-- Product cards will be injected here -->
    </div>
</div>

<script>
    const loadCards = async () => {
        const res = await fetch(`/api/product/searchByProdNameCateBrand`);
        const prodInfo = await res.json();
        // console.log(prodInfo);
        prodInfo.map(prod => {
            // console.log(prod);
        });

        const container = document.getElementById('productContainer');
        container.innerHTML = prodInfo.map(prod =>
         `
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card product-card h-100">
                    <img src="${prod.ProdImage}" class="card-img-top product-image" alt="${prod.ProdName}">
                    <div class="card-body d-flex flex-column">
                        <h5 class="product-title">${prod.ProdName}</h5>
                        <p class="product-text flex-grow-1">${prod.details}</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item product-tags"><strong>Category:</strong> ${prod.category}</li>
                        <li class="list-group-item product-tags"><strong>Brand:</strong> ${prod.brand}</li>
                        <li class="list-group-item text-success fs-5">
                            <strong>Price:</strong> <span class="text-dark">₹ ${parseFloat(prod.price).toLocaleString('en-IN', {minimumFractionDigits: 2})}</span>
                        </li>
                    <li class="list-group-item text-danger"><strong>Stock:</strong>${prod.stock}</li>
                    </ul>
                    <div class="card-body d-flex justify-content-between">
                        <a href="#" class="card-link text-primary">${prod.category}</a>
                        <a href="DisplayCart/${prod.Prodid}" class="card-link text-success">View Details</a>
                        <button class="btn btn-success w-100" onclick='addCart(${JSON.stringify(prod)})'>ADD CART</button>

                    </div>
                </div>
            </div>
        `).join('');
    }

    loadCards();
    
    const addCart = async (prod) => {
        console.log(prod);
    }
</script>

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

<!-- <a href="CartView/${prod.Prodid}" agar yaha se prodid na bhejte hue, sirf prod bhejna durust hai kya class="card-link text-primary">ADD CART</a> -->
