<!-- ================= EDIT PRODUCT MODAL ================= -->
<div class="modal fade" id="EditProductModal">
    <div class="modal-dialog">
        <form id="EditProductForm" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="editProdid">

                <select class="form-control mb-2" name="BrandId" id="editBrandSelect"></select>
                <select class="form-control mb-2" name="CateId" id="editCategorySelect"></select>
                <input type="text" class="form-control mb-2" id="editProdName" required>
                <input type="text" class="form-control mb-2" id="editDetails" required>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>


<script>
    // Reuse same fillSelect for dropdowns
    const fillSelect = async (url, selectId, valueKey, labelKey) => {
        try {
            const res = await fetch(url);
            const data = await res.json();
            const select = document.getElementById(selectId);
            select.innerHTML = `<option value="">Select</option>`;
            data.forEach(item => {
                const opt = new Option(item[labelKey], item[valueKey]);
                select.appendChild(opt);
            });
        } catch (e) {
            console.error("Dropdown load error:", e);
        }
    };
    document.addEventListener('DOMContentLoaded', () => {
        fillSelect('/api/brand', 'editBrandSelect', 'BrandId', 'BrandName');
        fillSelect('/api/category', 'editCategorySelect', 'CateId', 'CateName');
    });

    // Initialize dropdowns when modal is about to show
    function openEditModal(prod) {
        document.getElementById('editProdid').value = prod.Prodid;
        document.getElementById('editProdName').value = prod.ProdName;
        document.getElementById('editDetails').value = prod.details;
        document.getElementById('editBrandSelect').value = prod.BrandId;
        document.getElementById('editCategorySelect').value = prod.CateId;

        new bootstrap.Modal(document.getElementById('EditProductModal')).show();
    }


    document.getElementById('EditProductForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        const id = document.getElementById('editProdid').value;

        const data = {
            ProdName: document.getElementById('editProdName').value,
            details: document.getElementById('editDetails').value,
            CateId: document.getElementById('editCategorySelect').value,
            BrandId: document.getElementById('editBrandSelect').value,
        };

        try {
            const res = await fetch(`/api/product/${id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            });

            const result = await res.json();

            if (res.ok) {
                alert(result.message || 'Product updated!');
                bootstrap.Modal.getInstance(document.getElementById('EditProductModal')).hide();
                loadProducts(); // Refresh table
            } else {
                alert(result.message || 'Update failed');
            }
        } catch (err) {
            alert('Error: ' + err.message);
        }
    });
</script>