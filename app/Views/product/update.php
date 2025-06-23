<!-- category/update.php -->
<form id="UpdateProductForm">
    <input type="hidden" name="editprodId" id="editprodId">
    <!-- <input type="hidden" name="cateId" id="CateId"> -->
    <!-- <input type="hidden" name="brandId" id="BrandId"> -->

    <div class="mb-3">
        <label>Product Name</label>
        <input type="text" class="form-control" name="prodName" id="prodName" required>
    </div>

    <div class="mb-3">
        <label>Product Details</label>
        <input type="text" class="form-control" name="prodDetails" id="prodDetails" required>
    </div>

    <div class="mb-3">
        <label>Brand</label>
        <?= view('/brand/SelectOptionsBrand') ?>
    </div>

    <div class="mb-3">
        <label>Category</label>
        <?= view('/category/SelectOptionsCate') ?>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>

<script>
    fillSelect('/api/category', 'editCategorySelect', 'CateId', 'CateName');
    fillSelect('/api/brand', 'editBrandSelect', 'BrandId', 'BrandName');

    document.getElementById('UpdateProductForm').addEventListener('submit', async function(e) {
        e.preventDefault();

        const id = document.getElementById('editprodId').value;

        const ProdName = document.getElementById('prodName').value;
        const details = document.getElementById('prodDetails').value;

        const CateId = document.getElementById('editCategorySelect').value;
        const BrandId = document.getElementById('editBrandSelect').value;

        const data = {
            ProdName,
            details,
            CateId,
            BrandId
        };

        console.log(data);

        // ✅ PUT API call
        try {
            const response = await fetch(`/api/product/${id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            });

            const result = await response.json();

            if (response.ok) {
                alert(result.message || 'Product updated successfully!');
                // Optional: close modal if inside one
                const modalEl = document.getElementById('openProductEditModal');
                const modalInstance = bootstrap.Modal.getInstance(modalEl);
                if (modalInstance) modalInstance.hide();

                e.target.reset();
                // Call your reload function here, if needed
                loadCategories(); // or loadProducts(), etc.
            } else {
                const errors = result?.messages ? Object.values(result.messages).join('\n') : result.message;
                alert(errors || 'Update failed!');
            }

        } catch (err) {
            alert('Error: ' + err.message);
        }
    });
</script>