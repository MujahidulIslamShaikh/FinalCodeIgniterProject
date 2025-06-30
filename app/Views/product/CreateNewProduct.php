<?= $this->extend('/index') ?>
<?= $this->section('contentIndex') ?>
<style>
    .product-card {
        background-color: #fff;
        border-radius: 16px;
        padding: 30px;
        max-width: 1000px;
        margin: auto;
        box-shadow: 0 6px 16px rgba(25, 135, 84, 0.1);
        max-height: 90vh;
        overflow-y: auto;
    }

    .product-card input,
    .product-card select {
        border: 1px solid #ced4da;
        border-radius: 8px;
        padding: 4px 8px;
        /* 🟢 reduced padding */
        font-size: 0.85rem;
        /* 🟢 smaller font */
        height: auto;
        /* override Bootstrap default */
    }

    .product-card label {
        font-size: 0.9rem;
        margin-bottom: 2px;
        font-weight: bold;
    }

    .product-card input:focus,
    .product-card select:focus {
        border-color: #198754;
        outline: none;
        box-shadow: 0 0 0 0.15rem rgba(25, 135, 84, 0.25);
    }

    #previewImage {
        max-height: 120px;
        object-fit: contain;
        border-radius: 10px;
    }

    .scroll-container {
        overflow-y: auto;
        max-height: 70vh;
    }

    @media (max-width: 767px) {
        .product-card {
            padding: 20px;
        }
    }
</style>

<div class="container my-5">
    <div class="product-card">
        <form id="CreateProductForm">
            <div class="row g-4">
                <!-- Image preview section -->
                <div class="col-md-4 text-center">
                    <label for="ProdImage" class="form-label w-100">Product Image</label>
                    <input type="file" class="form-control form-control-sm" name="ProdImage" accept="image/*" id="ProdImage">
                    <div class="mt-2">
                        <img id="previewImage" src="#" alt="Preview" class="img-fluid d-none shadow-sm" />
                    </div>
                </div>  

                <!-- Inputs section -->
                <div class="col-md-8">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="CreateBrandSelect">Select Brand</label>
                            <select class="form-select" name="BrandId" id="CreateBrandSelect"></select>
                            <?= view('/brand/SelectOptionsBrand') ?>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#BrandModaal">+ New Brand</a>
                            <div id="error-BrandId" class="text-danger small"></div>
                        </div>

                        <div class="col-md-6">
                            <label for="CreateCategorySelect">Select Category</label>
                            <select class="form-select" name="CateId" id="CreateCategorySelect"></select>
                            <?= view('/category/SelectOptionsCate') ?>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#categoryModal">+ New Category</a>
                            <div id="error-CateId" class="text-danger small"></div>
                        </div>

                        <div class="col-md-6">
                            <label for="ProdName">Product Name</label>
                            <input type="text" class="form-control form-control-sm" name="ProdName" id="ProdName">
                            <div id="error-ProdName" class="text-danger small"></div>
                        </div>

                        <div class="col-md-6">
                            <label for="details">Product Details</label>
                            <input type="text" class="form-control form-control-sm" name="details" id="details">
                            <div id="error-details" class="text-danger small"></div>
                        </div>

                        <div class="col-md-6">
                            <label for="price">Product Price</label>
                            <input type="number" class="form-control form-control-sm" name="price" id="price">
                            <div id="error-price" class="text-danger small"></div>
                        </div>

                        <!-- ✅ You can add more inputs like this -->
                        <div class="col-md-6">
                            <label for="stock">Stock Quantity</label>
                            <input type="number" class="form-control form-control-sm" name="stock" id="stock">
                        </div>

                        <div class="col-12 text-end mt-3">
                            <button type="submit" class="btn btn-success px-4">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<?php
echo view('/brand/BrandModaal');
echo view('/category/CateModaal');
?>
<script>
    fillSelect('/api/brand', 'CreateBrandSelect', 'BrandId', 'BrandName');
    fillSelect('/api/category', 'CreateCategorySelect', 'CateId', 'CateName');

    document.getElementById('CreateProductForm').addEventListener('submit', async (e) => {
        e.preventDefault();

        const form = e.target;
        console.log(form);

        // Clear old errors
        ['BrandId', 'CateId', 'ProdName', 'details', 'price'].forEach(field => {
            const errorEl = document.getElementById('error-' + field);
            if (errorEl) errorEl.textContent = '';
        });

        // ✅ Send FormData directly (including file)
        const formData = new FormData(form);
        // console.log(formData);
        for (let [key, value] of formData.entries()) {
            console.log(`${key}:`, value);
        }
        console.log(formData);

        try {
            const res = await fetch('/api/product', {
                method: 'POST',
                body: formData // ✅ no need for JSON stringify
            });

            const result = await res.json();
            console.log(result);

            if (res.ok) {
                alert(result.message || 'Product created successfully!');
                form.reset();
            } else {
                const errors = result.messages || {};
                for (const field in errors) {
                    const errorEl = document.getElementById('error-' + field);
                    if (errorEl) {
                        errorEl.textContent = errors[field];
                    }
                }
            }
        } catch (err) {
            console.error('Request failed:', err);
        }
    });
</script>

<?= $this->endSection() ?>

<!-- =========== image file upload by api ========== -->
<!-- function handleImageUpload(file) {
        console.log(file);

    }
    document.getElementById('imagefile').addEventListener('change', function() {
        const imageinput = document.getElementById('imagefile');
        const imagefile = imageinput.files[0]
        handleImageUpload(imagefile);
    });
    -->