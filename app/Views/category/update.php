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
                bootstrap.Modal.getInstance(document.getElementById('openCategoryEditModal')).hide(); // ✅ Fixed ID
                e.target.reset();
                location.reload(); // Refresh table or category list if needed
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