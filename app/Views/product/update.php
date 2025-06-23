<!-- category/update.php -->
<form id="UpdateCategoryForm">
    <input type="text" name="editprodId" id="editprodId">
    <input type="text" name="cateId" id="CateId">
    <input type="text" name="brandId" id="BrandId">
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

    document.getElementById('UpdateCategoryForm').addEventListener('submit', async function(e) {
        e.preventDefault();

        const CateId = document.getElementById('editprodId').value;
        const prodName = document.getElementById('prodName').value;
        const prodDetails = document.getElementById('prodDetails').value;
        const cateId = document.getElementById('cateId').value;
        const BrandId = document.getElementById('prodDetails').value;

        const data = {
            CateName,
            prodDetails,
            cateId,
            BrandId
        };

        try {
            const response = await fetch(`/api/product/${CateId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            });

            const result = await response.json();

            if (response.ok) {
                alert(result.message || 'Category updated!');
                bootstrap.Modal.getInstance(document.getElementById('openCategoryEditModal')).hide(); // ✅ Fixed ID
                e.target.reset();
                // location.reload(); // Refresh table or category list if needed
                loadCategories();
            } else {
                const errorMessages = result.messages ?
                    Object.values(result.messages).join('\n') :
                    result.message || 'Update failed';
                alert(errorMessages);
            }
        } catch (err) {
            alert('Error: ' + err.message);
        }
    });
</script> 