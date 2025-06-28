<div class="mb-3">
    <label for="uploadImage" class="form-label">Product Image</label>
    <input type="file" class="uploadImage form-control" id="uploadImage" accept="image/*">
    <input type="hidden" name="ImageId" id="ImageId"> <!-- 👈 this goes to backend -->
    <div id="error-image" class="text-danger small"></div>

    <!-- Preview -->
    <div class="mt-2">
        <img id="imagePreview" src="#" alt="Image Preview" style="display:none; max-height: 100px;">
    </div>
</div>

<script>
    async function handleImageUpload(file) {
        const formData = new FormData();
        formData.append('image', file);
        formData.append('type', 'productsImage');
        
        // console.log(formData);

        try {
            const res = await fetch('/api/imageupload/upload', {
                method: 'POST',
                body: formData
            });

            const result = await res.json();
            // console.log(result);
            
            if (res.ok) {
                document.getElementById('ImageId').value = result.image_id;
                const preview = document.getElementById('imagePreview');
                preview.src = '/' + result.path;
                preview.style.display = 'block';
            } else {
                document.getElementById('error-image').textContent = result.messages?.image || 'Upload failed.';
            }
            return result;
        } catch (err) {
            document.getElementById('error-image').textContent = 'Upload failed: ' + err.message;
        }
    }
</script>


<!-- ====== ye ek method hai isko chalane ka [ without change ] ================  -->
<!-- // ✅ 1. Get the image file from input
    const imageInput = document.getElementById('uploadImage');
    const imageFile = imageInput.files[0];

    // ✅ 2. Upload image first (if file selected)
    if (imageFile) {
        const result = await handleImageUpload(imageFile); // call function directly
        if (result?.status) {
            document.getElementById('ImageId').value = result.image_id; // inject ID into form
        } else {
            document.getElementById('error-image').textContent = result.message || 'Image upload failed.';
            return; // stop further execution if image upload fails
        }
    } -->

<!-- ============ aut ye ek method hai hai ye image upload chalane ka { with change } ============ -->
<!-- 
document.getElementById('uploadImage').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        handleImageUpload(file);
    }
}); -->