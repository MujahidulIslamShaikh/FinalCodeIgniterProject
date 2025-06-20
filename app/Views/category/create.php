

<!-- partials/prod_Cate_From.php -->
<form id="CreateCategoryForm">
  <div class="mb-3">
    <label>Category Name</label>
    <input type="text" class="form-control" name="CateName" required>
  </div>
  <button type="submit" class="btn btn-primary">Create</button>
</form>

<script>
  document.getElementById('CreateCategoryForm').addEventListener('submit', async function(e) {
    e.preventDefault();

    const data = {
      CateName: e.target.CateName.value
    };

    try {
      const response = await fetch('/api/category', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
      });

      const result = await response.json();
      if (response.ok) {
        alert(result.message || 'Category created!');
        bootstrap.Modal.getInstance(document.getElementById('categoryModal')).hide();
        e.target.reset();
      } else {
        const errorMessages = result.messages ?
          Object.values(result.messages).join('\n') :
          result.message || 'Creation failed';
        alert(errorMessages);
      }

    } catch (err) {
      alert('Error: ' + err.message);
    }
  });
</script>