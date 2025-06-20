<!-- ================= List Category ====================== -->
<div class="container mt-5">
    <div class="d-flex justify-content-between ">
        <a href="#" data-bs-toggle="modal" data-bs-target="#categoryModal">+ New Category</a>

        <input type="text" id="categorySearchInput" class="form-control mb-3" placeholder="Search category by name...">
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
    // async function loadCategories() {
    //     try {
    //         const res = await fetch('/api/category');
    //         const category = await res.json();

    //         const tbody = document.querySelector('#categoryTable tbody');
    //         tbody.innerHTML = ''; // Clear existing rows

    //         category.forEach(cate => {
    //             const row = `
    //         <tr>
    //           <td>${cate.CateId}</td>
    //           <td>${cate.CateName}</td>
    //           <td>
    //             <button onclick="openCategoryEditModal(${cate['CateId']}, '${cate['CateName']}')" class="btn btn-sm btn-warning">Edit</button>
    //             <button onclick="deleteCategory(${cate['CateId']})" class="btn btn-sm btn-danger">Delete</button>
    //           </td>
    //         </tr>
    //       `;
    //             tbody.innerHTML += row;
    //         });
    //     } catch (err) {
    //         console.error('Failed to load categories:', err);
    //     }
    // }

    async function loadCategories(search = '') {
        const res = await fetch(`/api/category${search ? '?search=' + encodeURIComponent(search) : ''}`);
        const categories = await res.json();

        const tbody = document.querySelector('#categoryTable tbody');
        tbody.innerHTML = '';

        categories.forEach(cate => {
            const row = `
        <tr>
          <td>${cate.CateId}</td>
          <td>${cate.CateName}</td>
          <td>
            <button onclick="openCategoryEditModal(${cate.CateId}, '${cate.CateName}')" class="btn btn-sm btn-warning">Edit</button>
            <button onclick="deleteCategory(${cate.CateId})" class="btn btn-sm btn-danger">Delete</button>
          </td>
        </tr>
      `;
            tbody.innerHTML += row;
        });
    }
    document.getElementById('categorySearchInput').addEventListener('input', function() {
        const keyword = this.value.trim();
        loadCategories(keyword);
    });



    loadCategories();
</script>

<?php
echo view('/category/updateModal');
echo view('/category/deleteById');
?>

<!-- <script></script> -->