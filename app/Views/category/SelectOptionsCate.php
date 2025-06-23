
<script>
    const fillSelect = async (url, selectId, valueKey, labelKey) => {
        console.log("chala");
        try {
            const res = await fetch(url);
            const data = await res.json();
            const select = document.getElementById(selectId);
            select.innerHTML = `<option value="">Select</option>`;
            data.forEach(item => {
                const opt = new Option(item[labelKey], item[valueKey]);
                select.appendChild(opt);
            });
        } catch (e) {
            console.error("Dropdown load error:", e);
        }
    };

    // Ab tum kahin bhi call kar sakte ho:
    // fillSelect('/api/category', 'editCategorySelect', 'CateId', 'CateName');
    // fillSelect('/api/category', 'CategorySelect', 'CateId', 'CateName');
</script>


