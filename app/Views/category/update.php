<!-- category/update.php -->
<form id="UpdateCategoryForm">
    <input type="hidden" name="CateId" id="editCateId">
    <div class="mb-3">
        <label>Category Name</label>
        <input type="text" class="form-control" name="CateName" id="editCateName" required>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>


<script>
    document.getElementById('UpdateCategoryForm').addEventListener('submit', async function(e) {
        e.preventDefault();

        const CateId = document.getElementById('editCateId').value;
        const CateName = document.getElementById('editCateName').value;

        const data = {
            CateName
        };

        try {
            const response = await fetch(`/api/category/${CateId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            });

            const result = await response.json();

            if (response.ok) {
                alert(result.message || 'Category updated!');
                bootstrap.Modal.getInstance(document.getElementById('categoryModal')).hide();
                e.target.reset();
                // optionally: refresh category list if shown elsewhere
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

    // Function to open modal with existing category data
    function openCategoryEditModal(id, name) {
        document.getElementById('editCateId').value = id;
        document.getElementById('editCateName').value = name;

        const modal = new bootstrap.Modal(document.getElementById('categoryModal'));
        modal.show();
    }
</script>