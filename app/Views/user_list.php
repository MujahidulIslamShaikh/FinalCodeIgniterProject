<?= $this->extend('/index') ?>


<?= $this->section('contentIndex') ?>

<div class="container my-4">
    <h1 class="mb-4">Users Table</h1>
    <a href="/" class="btn btn-secondary mb-3">Back to Registration Form</a>

    <div class="table-responsive">

        <form method="get" class="mb-3 d-flex gap-2">
            <input type="text" name="q" value="<?= esc($search) ?>" class="form-control w-50" placeholder="Search name, role or contact">
            <button class="btn btn-primary">Search</button>
        </form>

        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Contact</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $prod): ?>
                    <tr>
                        <td><?= esc($prod['id']) ?></td>
                        <td><?= esc($prod['name']) ?></td>
                        <td><?= esc($prod['role']) ?></td>
                        <td><?= esc($prod['cont_num']) ?></td>
                        <td class="text-center">
                            <a href="/edit-user/<?= $prod['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="/delete-user/<?= $prod['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
                            <a href="javascript:void(0);" onclick="deleteUser(<?= $prod['id'] ?>)" class="btn btn-sm btn-danger">Delete By Api</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>

    <div class="mt-4">
        <?= $pager->links('users', 'my_custom_bootstrap') ?>
    </div>

</div>


<script>
    async function deleteUser(id) {
        if (!confirm("Are you sure you want to delete this user?")) return;

        try {
            const response = await fetch(`/api/users/${id}`, {
                method: 'DELETE'
            });

            const result = await response.json();

            if (response.ok) {
                alert(result.message || 'Deleted successfully');
                // Optionally: refresh or redirect
                window.location.reload(); // or window.location.href = '/user-list';
            } else {
                alert(result.message || 'Delete failed');
            }
        } catch (err) {
            alert("Error: " + err.message);
        }
    }
</script>

<?= $this->endSection();  ?>