<!-- category/update.php -->
<!-- <form id="UpdateProductForm" method="post" enctype="multipart/form-data"> -->
<form id="UpdateProductForm" enctype="multipart/form-data">
    <input type="hidden" name="editprodId" id="editprodId">
    <!-- <input type="hidden" name="cateId" id="CateId">-->
    <!-- <input type="hidden" name="brandId" id="BrandId"> -->

    <div class="mb-3">
        <label>Product Name</label>
        <input type="text" class="form-control" name="ProdName" id="prodName" required>
    </div>

    <div class="mb-3">
        <label>Product Details</label>
        <input type="text" class="form-control" name="details" id="prodDetails" required>
    </div>

    <div class="mb-3">
        <label>Brand</label>
        <select class="form-control mb-2" name="BrandId" id="editBrandSelect"></select>
        <?php
        echo view('brand/SelectOptionsBrand');
        ?>
    </div>

    <div class="mb-3">
        <label>Category</label>
        <select class="form-control mb-2" name="CateId" id="editCategorySelect"></select>
        <?php
        echo view('category/SelectOptionsCate')
        ?>
    </div>
    <div class="col-md-6 mb-3">
        <label for="ProdImage" class="form-label">Upload Product Image</label>
        <input type="file" name="ProdImage" accept="image/*" id="ProdImage">
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>

<script>
    fillSelect('/api/brand', 'editBrandSelect', 'BrandId', 'BrandName');
    fillSelect('/api/category', 'editCategorySelect', 'CateId', 'CateName');

    document.getElementById('UpdateProductForm').addEventListener('submit', async function(e) {
        e.preventDefault();

        const id = document.getElementById('editprodId').value;
        const form = e.target;
        const formData = new FormData(form)
          for (let [key, value] of formData.entries()) {
            console.log(`${key}:`, value);
        }

        // ✅ PUT API call
        try {

            const response = await fetch(`/api/product/${id}`, {
                method: 'post',
                // headers: {
                //     'Content-Type': 'application/json'
                // },
                // body: JSON.stringify(data)
                body: formData
            });
            const result = await response.json();
            console.log(result)

            if (response.ok) {
                alert(result.message || 'Product updated successfully!');
                // Optional: close modal if inside one
                const modalEl = document.getElementById('openProductEditModal');
                const modalInstance = bootstrap.Modal.getInstance(modalEl);
                if (modalInstance) modalInstance.hide();

                e.target.reset();
                // Call your reload function here, if needed
                loadProducts(); // or loadProducts(), etc.
            } else {
                const errors = result?.messages ? Object.values(result.messages).join('\n') : result.message;
                alert(errors || 'Update failed!');
            }

        } catch (err) {
            alert('Error: ' + err.message);
        }
    });
</script>

<!-- 
        // const ProdName = document.getElementById('prodName').value;
        // const details = document.getElementById('prodDetails').value;

        // const CateId = document.getElementById('editCategorySelect').value;
        // const BrandId = document.getElementById('editBrandSelect').value;
        // const ProdImage = document.getElementById('ProdImage').value;

        // const data = {
        //     ProdName,
        //     details,
        //     CateId,
        //     BrandId,
        //     ProdImage
        // }; -->
