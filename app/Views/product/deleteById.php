<script>
  async function deleteProduct(id) {
    if (!confirm("Are you sure you want to delete this category?")) return;

    try {
      const response = await fetch(`/api/product/${id}`, {
        method: 'DELETE'
      });

      const result = await response.json();

      if (response.ok) {
        alert(result.message || 'Category deleted successfully!');
        // Page refresh or table reload if needed
        // window.location.reload(); 
        loadProducts();

      } else {
        alert(result.message || 'Delete failed');
      }
    } catch (err) {
      alert('Error: ' + err.message);
    }
  }
</script>