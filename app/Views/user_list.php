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

<?=  $this->endSection();  ?>
