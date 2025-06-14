<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Table</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/">My App</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="/admin/dashboard">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="/user_list">User List</a></li>
                    <li class="nav-item"><a class="nav-link" href="/signup-user">Signup</a></li>
                    <li class="nav-item"><a class="nav-link" href="/login-user">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="/logout-user">Logout</a></li>
                    <li class="nav-item"><a class="nav-link" href="/display-file">display-file</a></li>
                </ul>
            </div>
        </div>
    </nav>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>