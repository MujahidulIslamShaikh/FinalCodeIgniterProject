<!DOCTYPE html>
<html lang="en">
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background-color: #343a40;
            padding: 20px;
            color: white;
        }

        .sidebar a {
            color: white;
            display: block;
            margin: 10px 0;
        }

        .content {
            flex: 1;
            padding: 20px;
        }

        .topbar {
            background: #f8f9fa;
            padding: 10px 20px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <h4>Admin</h4>
        <a href="/">Page</a>
        <a href="/admin/dashboard">Dashboard</a>
        <a href="/admin/logout">Logout</a>
        <a href="/admin/upload-file">Uploads Product</a>
        <a href="/admin/prod-action">Product Actions</a>
        <a href="/admin/mult-image-upload">Multiple Image Upload</a>
        <a href="/admin/product_list">Add Product</a>
        <!-- <a href="/admin/product_list">Create Product</a> -->
    </div>
    <div class="content">
        <div class="topbar">
            <h5>Welcome, Admin</h5>
        </div>
        <?= $this->renderSection('content') ?>
    </div>
</body>

</html>