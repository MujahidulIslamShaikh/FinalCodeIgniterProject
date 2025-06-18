<!-- product_form.php -->

<!-- Popup to Create Category Modal -->
<div class="modal fade" id="categoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <?= view('partials/prod_Cate_From') ?> <!-- yahi doosri file ka code load ho raha -->
            </div>
        </div>  
    </div>
</div>
<!-- Popup to Create Brand Modal -->
<div class="modal fade" id="brandModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Brand</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <?= view('partials/prod_Brand_From') ?> <!-- yahi doosri file ka code load ho raha -->
            </div>
        </div>  
    </div>
</div>
<!-- ============================== Product Form ===================== -->
<form id="CreateProductForm">
    <div class="mb-3">
        <select class="form-control" name="BrandId" id="brandSelect" required>
            <option value="">Select Brand</option>
        </select>
        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#brandModal">Create New Brand</a>
    </div>

    <div class="mb-3">
    <select class="form-control" name="CateId" id="categorySelect" required>
        <option value="">Select Category</option>
    </select>
    </div>

    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#categoryModal">Create New Category</a>
    <div class="mb-3">
        <label>Name</label>
        <input type="text" class="form-control" name="ProdName" required>
    </div>
    <div class="mb-3">
        <label>Details</label>
        <input type="text" class="form-control" name="details" required>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<script>
    document.getElementById('CreateProductForm').addEventListener('submit', async function(e) {
        e.preventDefault(); // form reload na ho

        const formData = new FormData(e.target);
        const data = Object.fromEntries(formData.entries());
        // const form = e.target;
        //   const data = {
        //     name: form.name.value,
        //     role: form.role.value,
        //     cont_num: form.cont_num.value
        //   };


        try {
            const response = await fetch('/api/product', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            });

            const result = await response.json();

            if (response.ok) {
                alert(result.message || 'Product created successfully!');
                e.target.reset(); // clear form
            } else {
                const errorMessages = result.messages ?
                    Object.values(result.messages).join('\n') :
                    result.message || 'Failed to create product';

                alert(errorMessages);
            }


        } catch (err) {
            console.error('Error:', err);
            alert('Something went wrong');
        }
    });
// ========== Category List By API   =========================
    document.addEventListener('DOMContentLoaded', async () => {
        const select = document.getElementById('categorySelect');

        try {
            const response = await fetch('/api/category');
            const categories = await response.json();

            if (Array.isArray(categories)) {    
                categories.forEach(cat => {
                    const option = document.createElement('option');
                    option.value = cat.CateId; // DB field
                    option.textContent = cat.CateName; // DB field
                    select.appendChild(option);
                });
            } else {
                console.error('Invalid category format', categories);
            }
        } catch (err) {
            console.error('Failed to fetch categories:', err);
        }
    });

    // ========== Brand List By API   =========================
    document.addEventListener('DOMContentLoaded', async () => {
        const select = document.getElementById('brandSelect');

        try {
            const response = await fetch('/api/brand');
            const brands = await response.json();

            if (Array.isArray(brands)) {
                brands.forEach(brand => {
                    const option = document.createElement('option');
                    option.value = brand.BrandId; // DB field
                    option.textContent = brand.BrandName; // DB field
                    select.appendChild(option);
                });
            } else {
                console.error('Invalid category format', brands);
            }
        } catch (err) {
            console.error('Failed to fetch brands:', err);
        }
    });


</script>