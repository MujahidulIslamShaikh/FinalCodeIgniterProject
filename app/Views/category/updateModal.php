<!-- Category Modal -->
<div class="modal fade" id="openCategoryEditModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <?= view('/category/update') ?>
        </div>
    </div>
</div>


<script>
    // =========== table me ki values Modaal me bhejne wala code hai  ====================
    // ✅ Function to open modal with existing category data

  function openCategoryEditModal(cateId, cateName) {
    document.getElementById('editCateId').value = cateId;
    document.getElementById('editCateName').value = cateName;

    const modal = new bootstrap.Modal(document.getElementById('openCategoryEditModal'));
    modal.show();
  }

</script>