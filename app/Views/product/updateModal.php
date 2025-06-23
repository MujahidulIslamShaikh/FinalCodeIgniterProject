<!-- Category Modal -->
<div class="modal fade" id="openProductEditModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <?= view('/product/update'); ?>
        </div>
    </div>
</div>


<script>
    // =========== table me ki values Modaal me bhejne wala code hai  ====================
    // ✅ Function to open modal with existing category data

    // function openProductEditModal(prodId, prodName, prodDetails, prodCateName, prodBrandName, cateId, brandId) {
    function openProductEditModal(prod) {   
        document.getElementById('editprodId').value = prod.Prodid;
        // document.getElementById('CateId').value = prod.CateId;
        // document.getElementById('BrandId').value = prod.BrandId;
        document.getElementById('prodName').value = prod.ProdName;
        document.getElementById('prodDetails').value = prod.details;
        document.getElementById('editCategorySelect').value = prod.CateId;
        document.getElementById('editBrandSelect').value = prod.BrandId;

        const modal = new bootstrap.Modal(document.getElementById('openProductEditModal'));
        modal.show();

    }
</script>