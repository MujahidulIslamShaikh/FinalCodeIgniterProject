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




<div class="container mt-5">
    <a href="/CreateProductView">Create Product</a>
    <form class="mb-3">
        <select id="categoryFilter" class="form-select w-25 d-inline-block">
            <option value="">All Categories</option>
            <?php foreach ($categories as $cat): ?>
                <option value="<?= esc($cat['CateId']) ?>"><?= esc($cat['CateName']) ?></option>
            <?php endforeach; ?>
        </select>
    </form>

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
                </tr>
            </thead>
            <tbody>
                <!-- API data will be inserted here -->
            </tbody>
        </table>
    </div>
</div>

<script>
    async function loadProducts(categoryId = '') {
        try {
            const res = await fetch('/api/FilterProdCate' + (categoryId ? `?category=${categoryId}` : '') );
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
            </tr>
          `;
                tbody.innerHTML += row;
            });
        } catch (err) {
            console.error('Failed to load users:', err);a
        }
    }
    
  // Dropdown filter
  document.getElementById('categoryFilter').addEventListener('change', function () {
    loadProducts(this.value);
  });

    loadProducts();
</script>

<?= $this->endSection() ?>