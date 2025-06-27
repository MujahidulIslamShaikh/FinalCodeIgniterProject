<div class="mb-3">
    <label for="uploadImage" class="form-label">Product Image Update</label>
    <input type="file" class="form-control" id="uploadImage" accept="image/*">
    <input type="hidden" name="ImageId" id="ImageId"> <!-- 👈 this goes to backend -->
    <div id="error-image" class="text-danger small"></div>

    <!-- Preview -->
    <div class="mt-2">
        <img id="imagePreview" src="#" alt="Image Preview" style="display:none; max-height: 100px;">
    </div>
</div>

<script>
document.getElementById('uploadImage').addEventListener('change', async function (e) {
    const file = e.target.files[0];
    const formData = new FormData();
    formData.append('image', file);
    formData.append('type', 'productsImage'); // optional, based on use

    try {
        const res = await fetch('/api/imageupload/update', {
            method: 'POST',
            body: formData
        });

        const result = await res.json();

        if (res.ok) {
            // ✅ Set image ID to hidden input
            document.getElementById('ImageId').value = result.image_id;

            // ✅ Preview
            const preview = document.getElementById('imagePreview');
            preview.src = '/' + result.path;
            preview.style.display = 'block';
        } else {
            document.getElementById('error-image').textContent = result.messages?.image || 'Upload failed.';
        }
    } catch (err) {
        document.getElementById('error-image').textContent = 'Upload failed: ' + err.message;
    }
});
</script>
