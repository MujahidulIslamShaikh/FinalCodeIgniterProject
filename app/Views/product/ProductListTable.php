<?= $this->extend('/index') ?>
<?= $this->section('contentIndex') ?>


<style>
    .custom-table {
        background-color: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .custom-table thead {
        background-color: #343a40;
        color: white;
    }

    #searchProduct::placeholder {
        font-style: italic;
        color: #6c757d;
    }

    .input-group-text {
        border-right: 0;
    }

    #searchProduct:focus {
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }
</style>

<div class="container mt-5">
    <a href="/CreateProductView">Create Product</a>
    <h3 class="mb-4 text-center">Product List</h3>
    <div class="mb-4">
        <label for="searchProduct" class="form-label fw-semibold text-dark">🔍 Search Products</label>
        <div class="input-group shadow-sm rounded">
            <span class="input-group-text bg-dark text-white"><i class="bi bi-search"></i></span>
            <input type="search" class="form-control border-0" id="searchProduct"
                placeholder="Search by Product Name, Category or Brand...">
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered" id="productTable">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Product Details</th>
                    <th>Product category Name</th>
                    <th>Product Brand Name</th>
                </tr>
            </thead>
            <tbody>
                <!-- API data will be inserted here -->
            </tbody>
        </table>
    </div>
</div>
<script>
    async function loadProducts(search = '') {
        try {
            // const res = await fetch('/api/product');
            // const res = await fetch('/api/product/searchByProductName' + (search ? `?search=${search}` : ''));
            const res = await fetch('/api/product/searchByProdNameCateBrand' + (search ? `?search=${search}` : ''));

            const products = await res.json();

            const tbody = document.querySelector('#productTable tbody');
            tbody.innerHTML = ''; // Clear existing rows  

            products.forEach(prod => {
                const row = `
            <tr>
              <td>${prod.Prodid}</td>
              <td>${prod.ProdName}</td>
              <td>${prod.details}</td>
              <td>${prod.category}</td>
              <td>${prod.brand}</td>
              <td>
                <button onclick='openProductEditModal(${JSON.stringify(prod)})' class="btn btn-sm btn-warning">Edit</button>
                <button onclick="deleteProduct(${prod.Prodid})" class="btn btn-sm btn-danger">Delete</button>
              </td>
            </tr>
          `;
                tbody.innerHTML += row;
            });
        } catch (err) {
            console.error('Failed to load users:', err);
        }
    }
    loadProducts();
    document.getElementById('searchProduct').addEventListener('input', function() {
        // console.log(this.value);
        loadProducts(this.value)
    });
</script>
<?= view('/product/deleteById'); ?>
<?= view('/product/updateModal'); ?>

<?= $this->endSection() ?>