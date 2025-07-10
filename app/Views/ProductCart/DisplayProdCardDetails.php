<?= $this->extend('/index') ?>
<?= $this->section('contentIndex') ?>

<div class="container py-5">
	<h2 class="mb-4">View Product Details Here...</h2>
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
                        <img src="/${prod.ProdImage || '/assets/no-image.png'}" 
                            class="img-fluid rounded-start" 
                            alt="${prod.ProdName}">
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

<!-- <script>
    const loadCards = async () => {
        const res = await fetch(`/api/product/searchByProdNameCateBrand`);
        const prodInfo = await res.json();

        const container = document.getElementById('productContainer');
        container.innerHTML = prodInfo.map(prod => `
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
                    </ul>
                    <div class="card-body d-flex justify-content-between">
                        <a href="#" class="card-link text-primary">${prod.category}</a>
                        <a href="addtocartview" class="card-link text-success">addtocartview</a>
                    </div>
                </div>
            </div>
        `).join('');
    }

    loadCards();
</script> -->
<!-- <img src="${prod.ProdImage ?? '/assets/no-image.png'}" width="60" height="60" alt="${prod.ProdName}"> -->


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