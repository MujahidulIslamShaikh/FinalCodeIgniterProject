<?= $this->extend('/index') ?>
<?= $this->section('contentIndex') ?>

<style>
    .product-form {
        background-color: #ffffff;
        border-radius: 16px;
        padding: 30px;
        max-width: 700px;
        margin: auto;
        box-shadow: 0 6px 16px rgba(25, 135, 84, 0.1);
    }

    .product-form label {
        font-weight: 600;
        color: #198754;
        margin-bottom: 6px;
    }

    .product-form input,
    .product-form select {
        border: 1px solid #ced4da;
        border-radius: 8px;
        padding: 10px 12px;
        font-size: 0.95rem;
        transition: border-color 0.2s;
    }

    .product-form input:focus,
    .product-form select:focus {
        border-color: #198754;
        outline: none;
        box-shadow: 0 0 0 0.15rem rgba(25, 135, 84, 0.25);
    }

    .product-form a {
        font-size: 0.85rem;
        color: #0d6efd;
        text-decoration: none;
        display: inline-block;
        margin-top: 4px;
    }

    .product-form a:hover {
        text-decoration: underline;
    }

    .form-footer {
        text-align: right;
    }

    @media (max-width: 576px) {
        .product-form {
            padding: 20px;
        }
    }
</style>

<div class="container my-5">
    <div class="bg-white p-4 rounded-4 shadow-sm" style="max-width: 700px; margin: auto;">
        <form id="CreateProductForm">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="CreateBrandSelect" class="form-label">Select Brand</label>
                    <select class="form-select" name="BrandId" id="CreateBrandSelect"></select>
                    <?= view('/brand/SelectOptionsBrand') ?>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#BrandModaal">+ New Brand</a>
                    <div id="error-BrandId" class="text-danger small"></div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="CreateCategorySelect" class="form-label">Select Category</label>
                    <select class="form-select" name="CateId" id="CreateCategorySelect"></select>
                    <?= view('/category/SelectOptionsCate') ?>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#categoryModal">+ New Category</a>
                    <div id="error-CateId" class="text-danger small"></div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="ProdName" class="form-label">Product Name</label>
                    <input type="text" class="form-control" name="ProdName" id="ProdName" required>
                    <div id="error-ProdName" class="text-danger small"></div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="details" class="form-label">Product Details</label>
                    <input type="text" class="form-control" name="details" id="details">
                    <div id="error-details" class="text-danger small"></div>
                </div>
                <?php
                echo view('components/ImageUploadField');
                ?>

            </div>

            <div class="text-end mt-3">
                <button type="submit" class="btn btn-success px-4">Submit</button>
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

        // Clear old errors
        ['BrandId', 'CateId', 'ProdName', 'details'].forEach(field => {
            const errorEl = document.getElementById('error-' + field);
            if (errorEl) errorEl.textContent = '';
        });

        const data = Object.fromEntries(new FormData(form).entries());
        console.log(data);
        try {
            const res = await fetch('/api/product', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            });

            const result = await res.json();

            if (res.ok) {
                alert(result.message || 'Product created successfully!');
                form.reset();
                window.location.href = "/ProductView"; // 🔁 Redirect
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