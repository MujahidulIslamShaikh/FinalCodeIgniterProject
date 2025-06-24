<?= $this->extend('/index') ?>
<?= $this->section('contentIndex') ?>

<style>
    .custom-table {
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .custom-table thead {
        background-color: #198754;
        color: white;
    }

    .filter-select,
    #searchProduct {
        max-width: 100%;
        border-radius: 6px;
    }

    .search-box .input-group-text {
        background-color: #198754;
        color: #fff;
        border: none;
    }

    @media (max-width: 576px) {

        .btn,
        .form-control {
            font-size: 0.875rem;
        }
    }
</style>

<?= view('/product/updateModal') ?>

<div class="container py-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
        <a href="/pdf/product_list_pdf" target="_blank" class="btn btn-success">
            View Product PDF
        </a>

        <h3 class="mb-0 text-success fw-semibold">📦 Product List</h3>
        <a href="/CreateNewProduct" class="btn btn-success">+ Add Product</a>
    </div>

    <div class="row g-3 mb-3">
        <div class="col-md-4">
            <select class="form-control mb-2" name="BrandId" id="BrandSelect"></select>

            <?php
            echo view('brand/SelectOptionsBrand');
            ?>
        </div>
        <div class="col-md-4">
            <select class="form-control mb-2" name="CateId" id="CategorySelect"></select>
            <?php
            echo view('category/SelectOptionsCate')
            ?>
        </div>
        <div class="col-md-4">
            <label for="searchProduct" class="form-label fw-semibold">🔍 Search</label>
            <div class="input-group search-box shadow-sm">
                <span class="input-group-text"><i class="bi bi-search"></i></span>
                <input type="search" id="searchProduct" class="form-control" placeholder="Name, Brand or Category">
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table custom-table table-bordered align-middle" id="productTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Details</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<script>
    fillSelect('/api/brand', 'BrandSelect', 'BrandId', 'BrandName');
    fillSelect('/api/category', 'CategorySelect', 'CateId', 'CateName');


    const loadProducts = async (search = '') => {
        try {
            const res = await fetch(`/api/product/searchByProdNameCateBrand${search ? `?search=${encodeURIComponent(search)}` : ''}`);
            const products = await res.json();
            const tbody = document.querySelector('#productTable tbody');
            tbody.innerHTML = products.map(prod => `
                <tr>
                    <td>${prod.Prodid}</td>
                    <td>${prod.ProdName}</td>
                    <td>${prod.details}</td>
                    <td>${prod.category}</td>
                    <td>${prod.brand}</td>
                    <td>
                        <button onclick='openProductEditModal(${JSON.stringify(prod)})' class="btn btn-sm btn-outline-warning">Edit</button>
                        <button onclick="deleteProduct(${prod.Prodid})" class="btn btn-sm btn-outline-danger">Delete</button>
                    </td>
                </tr>
            `).join('');
        } catch (err) {
            console.error('Failed to load products:', err);
        }
    };
    document.getElementById("BrandSelect").addEventListener('change', function() {
        loadProducts(this.options[this.selectedIndex].text);
    });
    document.getElementById("CategorySelect").addEventListener('change', function() {
        loadProducts(this.options[this.selectedIndex].text);
    });
    document.getElementById('searchProduct').addEventListener('input', function() {
        loadProducts(this.value)
    });
    loadProducts();
</script>

<?= view('/product/deleteById') ?>
<?= $this->endSection() ?>