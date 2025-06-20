<!-- ================= List Category ====================== -->
<div class="container mt-5">
    <div class="d-flex justify-content-between ">
        <a href="#" data-bs-toggle="modal" data-bs-target="#categoryModal">+ New Category</a>

        <a href="/CreateProductView">Create Product</a>
    </div>
    <h3 class="mb-4 text-center">Product List</h3>
    <div class="table-responsive">
        <table class="table table-bordered" id="categoryTable">
            <thead class="table-dark">
                <tr>
                    <th>Category ID</th>
                    <th>Category Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- API data will be inserted here -->
            </tbody>
        </table>
    </div>
</div>
<!-- ============= Category Modaal ===========  -->
<?php 
echo view('/category/CateModaal'); 
// echo view('/category/updateModal'); 
?>


<script>
    async function loadProducts() {
        try {
            const res = await fetch('/api/category');
            const category = await res.json();

            const tbody = document.querySelector('#categoryTable tbody');
            tbody.innerHTML = ''; // Clear existing rows

            category.forEach(cate => {
                const row = `
            <tr>
              <td>${cate.CateId}</td>
              <td>${cate.CateName}</td>
              <td>
                <button onclick="openCategoryEditModal(${cate['CateId']}, '${cate['CateName']}')" class="btn btn-sm btn-warning">Edit</button>
              </td>
            </tr>
          `;
                tbody.innerHTML += row;
            });
        } catch (err) {
            console.error('Failed to load categories:', err);
        }
    }

    loadProducts();
</script>

<?php echo view('/category/updateModal');   ?>

<!-- <script></script> -->