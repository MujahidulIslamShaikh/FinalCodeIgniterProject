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
    // =========== table me ki values Modaal me bhejne wala code hai ye ====================
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
        fillSelect('/api/category', 'categorySelect', 'CateId', 'CateName');
        // fillSelect('/api/brand', 'brandSelect', 'BrandId', 'BrandName');
    });
</script>