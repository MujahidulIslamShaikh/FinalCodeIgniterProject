<input type="text" id="searchInput" placeholder="Search category..." class="form-control mb-3" />

<table class="table">
    <thead>
        <tr><th>ID</th><th>Name</th></tr>
    </thead>
    <tbody id="categoryTableBody">
        <!-- Dynamic rows -->
    </tbody>
</table>

<script>
    const searchInput = document.getElementById('searchInput');
    const tableBody = document.getElementById('categoryTableBody');

    searchInput.addEventListener('input', async function () {
        const search = this.value.trim();
        const res = await fetch(`/api/category/search?search=${encodeURIComponent(search)}`);
        const data = await res.json();

        tableBody.innerHTML = '';
        data.forEach(cat => {
            tableBody.innerHTML += `
                <tr>
                    <td>${cat.CateId}</td>
                    <td>${cat.CateName}</td>
                </tr>`;
        });
    });
</script>
