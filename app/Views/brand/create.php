

<!-- category/create.php -->
<form id="CreateBrandForm">
  <div class="mb-3">
    <label>Brand Name</label>
    <input type="text" class="form-control" name="BrandName" required>
  </div>
  <button type="submit" class="btn btn-primary">Create</button>
</form>

<script>
  document.getElementById('CreateBrandForm').addEventListener('submit', async function(e) {
    e.preventDefault();

    const data = {
      BrandName: e.target.BrandName.value
    };

    try {
      const response = await fetch('/api/brand', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
      });

      const result = await response.json();
      if (response.ok) {
        alert(result.message || 'Category created!');
        bootstrap.Modal.getInstance(document.getElementById('BrandModaal')).hide();
        e.target.reset();
        window.location.reload();
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