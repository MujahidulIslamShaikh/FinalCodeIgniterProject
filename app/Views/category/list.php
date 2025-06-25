<style>
    .section-header {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .section-header a,
    .section-header input {
        margin-bottom: 0.5rem;
    }

    .custom-btns a {
        border-radius: 8px;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
    }

    .table-responsive {
        background-color: #fff;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 0 12px rgba(0, 0, 0, 0.05);
    }

    .table thead th {
        background-color: #198754;
        color: white;
    }

    .container h3 {
        font-weight: 600;
        color: #198754;
        margin-top: 2rem;
    }
</style>

<div class="container mt-5">
    <h3 class="text-center">📂 Category List</h3>

    <div class="d-flex flex-wrap gap-2 justify-content-center custom-btns mb-4">
        <a href="CreateNewProduct" class="btn btn-primary">
            ➕ Create Product
        </a>
        <a href="/pdf/product_list_pdf" target="_blank" class="btn btn-outline-success">
            📄 Product PDF
        </a>
        <a href="/pdf/Brand_list_pdf" target="_blank" class="btn btn-outline-success">
            📄 Brand PDF
        </a>
        <a href="/pdf/cateListpdf" target="_blank" class="btn btn-outline-success">
            📄 Category PDF
        </a>
    </div>
    <div class="section-header">
        <a href="#" data-bs-toggle="modal" data-bs-target="#categoryModal" class="btn btn-outline-primary">
            ➕ New Category
        </a>

        <input type="text" id="categorySearchInput" class="form-control w-50" placeholder="🔍 Search category by name...">

        <a href="/CreateNewProduct" class="btn btn-outline-secondary">
            ➕ Create Product
        </a>
    </div>



    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle" id="categoryTable">
            <thead>
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
    async function loadCategories(search = '') {
        console.log(search);
        // const res = await fetch(`/api/category${search ? '?search=' + encodeURIComponent(search) : ''}`);
        const res = await fetch(`/api/category${search ? '/search?search=' + encodeURIComponent(search) : ''}`);

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



<!-- <script>

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


</script> -->