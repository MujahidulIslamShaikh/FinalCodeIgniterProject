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
</style>

<!-- Category Modal -->
<div class="modal fade" id="categoryModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <?= view('partials/prod_Cate_From.php') ?>
        </div>
    </div>
</div>

<!-- ================= List Product and filter ====================== -->
<div class="container mt-5">
    <form class="">
        <select id="categoryFilter" class="form-select w-25 d-inline-block">
            <option value="">All Categories</option>
            <?php foreach ($categories as $cat): ?>
                <option value="<?= esc($cat['CateId']) ?>"><?= esc($cat['CateName']) ?></option>
            <?php endforeach; ?>
        </select>
        <!-- <input type="text" id="searchInput" class="form-control w-50" placeholder="Search by name or details"> -->

    </form>
    <div class="d-flex justify-content-between ">
        <a href="#" data-bs-toggle="modal" data-bs-target="#categoryModal">+ New Category</a>

        <a href="/CreateProductView">Create Product</a>
    </div>
<input type="search" class="form-control" id="SearchProductTableInput">
    <h3 class="mb-4 text-center">Product List</h3>
    <div class="table-responsive">
        <table class="table table-bordered" id="productTable">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Product Details</th>
                    <th>Product category</th>
                    <th>Product brand</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- API data will be inserted here -->
            </tbody>
        </table>
    </div>
</div>
<?= view('/partials/update_product_form') ?>




<script>
    async function loadProducts(categoryId = '') {
        try {
            const res = await fetch('/api/FilterProdByCate' + (categoryId ? `?category=${categoryId}` : ''));
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
              <td class="text-center">
    			
                            <button onclick='openEditModal(${JSON.stringify(prod)})' class="btn btn-warning btn-sm">Editt</button>

                <button class="btn btn-sm btn-danger" onclick="deleteProduct(${prod.Prodid})">Delete</button>
              </td> 
            </tr>
          `;
                tbody.innerHTML += row;
            });
        } catch (err) {
            console.error('Failed to load users:', err);
        }
    }

    // Dropdown filter
    document.getElementById('categoryFilter').addEventListener('change', function() {
        loadProducts(this.value);
    });
   document.getElementById("SearchProductTableInput").addEventListener('input', function() {
        const keyword = this.value.trim();
        console.log(keyword);
        // loadProducts(keyword);

   });

    loadProducts();


    // ================================ DELETE ==========================
    async function deleteProduct(id) {
        if (!confirm("Are you sure you want to delete this user?")) return;

        try {
            const response = await fetch(`/api/product/${id}`, {
                method: 'DELETE'
            });

            const result = await response.json();

            if (response.ok) {
                alert(result.message || 'Deleted successfully');
                // Optionally: refresh or redirect
                window.location.reload(); // or window.location.href = '/user-list';
            } else {
                alert(result.message || 'Delete failed');
            }
        } catch (err) {
            alert("Error: " + err.message);
        }
    }
  
</script>





<!-- <script>
    async function loadProducts(categoryId = '', search = '') {
        const query = new URLSearchParams();
        if (categoryId) query.append('category', categoryId);
        if (search) query.append('search', search);

        try {
            const res = await fetch('/api/product?' + query.toString());
            const products = await res.json();

            const tbody = document.querySelector('#productTable tbody');
            tbody.innerHTML = '';

            products.forEach(prod => {
                const row = `
      <tr>
        <td>${prod.Prodid}</td>
        <td>${prod.ProdName}</td>
        <td>${prod.details}</td>
        <td>${prod.category}</td>
        <td>${prod.brand}</td>
      </tr>
    `;
                tbody.innerHTML += row;
            });

        } catch (err) {
            console.error('Failed to load products:', err);
        }
    }

    const categoryInput = document.getElementById('categoryFilter');
    const searchInput = document.getElementById('searchInput');

    function filterProducts() {
        const category = categoryInput.value;
        const search = searchInput.value.trim();
        loadProducts(category, search);
    }

    categoryInput.addEventListener('change', filterProducts);
    searchInput.addEventListener('input', filterProducts);

    loadProducts(); // Initial load
</script> -->


<?= $this->endSection() ?>