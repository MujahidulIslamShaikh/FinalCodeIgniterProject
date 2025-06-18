<!-- Category Modal -->
<div class="modal fade" id="categoryModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body"><?= view('partials/prod_Cate_From') ?></div>
        </div>
    </div>
</div>

<!-- Brand Modal -->
<div class="modal fade" id="brandModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Brand</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body"><?= view('partials/prod_Brand_From') ?></div>
        </div>
    </div>
</div>

<!-- Product Form -->
<form id="CreateProductForm">
    <div class="mb-3">
        <select class="form-control" name="BrandId" id="brandSelect" required>
            <option value="">Select Brand</option>
        </select>
        <a href="#" data-bs-toggle="modal" data-bs-target="#brandModal">+ New Brand</a>
    </div>

    <div class="mb-3">
        <select class="form-control" name="CateId" id="categorySelect" required>
            <option value="">Select Category</option>
        </select>
        <a href="#" data-bs-toggle="modal" data-bs-target="#categoryModal">+ New Category</a>
    </div>

    <div class="mb-3">
        <label>Name</label>
        <input type="text" class="form-control" name="ProdName" required>
    </div>

    <div class="mb-3">
        <label>Details</label>
        <input type="text" class="form-control" name="details" required>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<script>
    const fillSelect = async (url, selectId, valueKey, labelKey) => {
        try {
            const res = await fetch(url);
            const data = await res.json();
            if (Array.isArray(data)) {
                const select = document.getElementById(selectId);
                data.forEach(item => {
                    const opt = new Option(item[labelKey], item[valueKey]);
                    select.appendChild(opt);
                });
            }
        } catch (e) {
            console.error(`Failed to load ${selectId}`, e);
        }
    };

    document.addEventListener('DOMContentLoaded', () => {
        fillSelect('/api/brand', 'brandSelect', 'BrandId', 'BrandName');
        fillSelect('/api/category', 'categorySelect', 'CateId', 'CateName');
    });

    document.getElementById('CreateProductForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        const data = Object.fromEntries(new FormData(e.target).entries());

        try {
            const res = await fetch('/api/product', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            });
            const result = await res.json();
            alert(res.ok ? result.message || 'Product created!' : Object.values(result.messages || {
                error: result.message
            }).join('\n'));
            if (res.ok) e.target.reset();
        } catch (err) {
            alert('Error: ' + err.message);
        }
    });
</script>