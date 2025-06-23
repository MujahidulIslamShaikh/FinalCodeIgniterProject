<?= $this->extend('/index') ?>
<?= $this->section('contentIndex') ?>

<style>
    .product-form {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 20px;
        max-width: 600px;
        margin: auto;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.08);
    }

    .product-form label {
        font-weight: 500;
        display: block;
        margin-bottom: 5px;
    }

    .product-form select,
    .product-form input {
        width: 100%;
        padding: 6px 10px;
        border: 1px solid #198754;
        border-radius: 4px;
        font-size: 0.9rem;
    }

    .product-form .mb {
        margin-bottom: 15px;
    }

    .product-form a {
        font-size: 0.85rem;
        margin-top: 4px;
        display: inline-block;
    }

    @media (max-width: 576px) {
        .product-form {
            padding: 15px;
        }
    }
</style>

<div class="product-form">
    <form id="CreateProductForm">

        <div class="mb">
            <label for="brandSelect">Select Brand</label>
            <select class="form-control mb-2" name="BrandId" id="CreateBrandSelect"></select>
            <?php
            echo view('/brand/SelectOptionsBrand');
            ?>
            <a href="#" data-bs-toggle="modal" data-bs-target="#BrandModaal">+ New Brand</a>
        </div>

        <div class="mb">
            <label for="categorySelect">Select Category</label>
            <select class="form-control mb-2" name="CateId" id="CreateCategorySelect"></select>
            <?php
            echo view('/category/SelectOptionsCate');
            ?>
            <a href="#" data-bs-toggle="modal" data-bs-target="#categoryModal">+ New Category</a>
        </div>

        <div class="mb">
            <label for="ProdName">Product Name</label>
            <input type="text" name="ProdName" id="ProdName" required>
        </div>

        <div class="mb">
            <label for="details">Product Details</label>
            <input type="text" name="details" id="details" required>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
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
        const data = Object.fromEntries(new FormData(e.target).entries());
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
            alert(res.ok ? result.message || 'Product created!' : Object.values(result.messages || {
                error: result.message
            }).join('\n'));
            if (res.ok) {
                e.target.reset();
                window.location.href = "/ProductView";
            }
        } catch (err) {
            alert('Error: ' + err.message);
        }
    });
</script>



<?= $this->endSection() ?>