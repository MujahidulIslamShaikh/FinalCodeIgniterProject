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
            .cursor-pointer{
                cursor: pointer;
            }
        </style>

        <?= view('/product/updateModal') ?>

        <div class="container py-4">
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                <a href="/pdf/product_list_pdf" target="_blank" class="btn btn-success">
                    View Products PDF
                </a>
                <h3 class="mb-0 text-success fw-semibold">📦 Product List</h3>
                <a href="/CreateNewProduct" class="btn btn-success">+ Add Product</a>
            </div>

            <div class="row g-3 mb-3">

                <div class="col-md-4 d-flex align-items-center gap-2">
                    <label for="BrandSelect" class="form-label fw-semibold mb-0" style="white-space: nowrap;">🔍 Brand</label>
                    <select class="form-control" name="BrandId" id="BrandSelect" style="min-width: 0;"></select>
                    <?= view('brand/SelectOptionsBrand'); ?>
                </div>

                <div class="col-md-4 d-flex align-items-center gap-2">
                    <label for="CategorySelect" class="form-label fw-semibold mb-0" style="white-space: nowrap;">🔍 Category</label>
                    <select class="form-control" name="CateId" id="CategorySelect" style="min-width: 0;"></select>
                    <?= view('category/SelectOptionsCate'); ?>
                </div>

                <div class="col-md-4 d-flex align-items-center gap-2">
                    <label for="searchProduct" class="form-label fw-semibold mb-0" style="white-space: nowrap;">🔍 Search</label>
                    <div class="input-group shadow-sm flex-grow-1">
                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                        <input type="search" id="searchProduct" class="form-control" placeholder="Name, Brand or Category">
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table custom-table table-bordered align-middle" id="productTable">
                    <thead>
                        <tr>
                            <!-- <th>ID<i onclick="filterid()" class="bi bi-sort-numeric-down cursor-pointer"></i></th> ye barabar hai kya -->
                            <th>ID <i onclick="filterid()" class="bi bi-sort-numeric-down cursor-pointer"></i></th>

                            <th>Name</th>
                            <th>Details</th>
                            <th>Category</th>
                            <th>Brand</th>
                            <th class="text-success">PRICE</th>
                            <th>STOCK</th>
                            <th>Product Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>

        <script>
            let sortOrder = 'asc'; // Toggle between 'asc' and 'desc'
            fillSelect('/api/brand', 'BrandSelect', 'BrandId', 'BrandName');
            fillSelect('/api/category', 'CategorySelect', 'CateId', 'CateName');

            const loadProducts = async (search = '', sortField = '', sortOrder = '') => {
                const queryParams = new URLSearchParams();
                if (search) queryParams.append('search', search);
                if (sortField) queryParams.append('sortField', sortField);
                if (sortOrder) queryParams.append('sortOrder', sortOrder);
                try {
                    const res = await fetch(`/api/product/searchByProdNameCateBrand?${queryParams.toString()}`);
                    const products = await res.json();
                    const tbody = document.querySelector('#productTable tbody');
                    tbody.innerHTML = products.map(prod => `
                        <tr>
                            <td>${prod.Prodid}</td>
                            <td>${prod.ProdName}</td>
                            <td>${prod.details}</td>
                            <td>${prod.category}</td>
                            <td>${prod.brand}</td>
                            <td class="text-success">${prod.price}</td>
                            <td>${prod.stock}</td>
                            <td>
                                <img src="${prod.ProdImage ?? '/assets/no-image.png'}" width="60" height="60">
                            </td>
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
            let selectedBrand = '';
            let selectedCategory = '';
            let currentSearch = '';
            document.getElementById("BrandSelect").addEventListener('change', function() {
                loadProducts(this.options[this.selectedIndex].text);
                // loadProducts(currentSearch, 'Prodid', sortOrder);
            });
            document.getElementById("CategorySelect").addEventListener('change', function() {
                loadProducts(this.options[this.selectedIndex].text);
                //  loadProducts(currentSearch, 'Prodid', sortOrder);
            });
            document.getElementById('searchProduct').addEventListener('input', function() {
                loadProducts(this.value)
                // loadProducts(currentSearch, 'Prodid', sortOrder);
            });
            loadProducts();

            function filterid() {
                sortOrder = sortOrder === 'asc' ? 'desc' : 'asc';
                loadProducts('', 'Prodid', sortOrder);

                const icon = document.querySelector('th i');
                icon.className = sortOrder === 'asc' ? 'bi bi-sort-numeric-up' : 'bi bi-sort-numeric-down';
            }
        </script>

        <?= view('/product/deleteById') ?>
        <?= $this->endSection() ?>