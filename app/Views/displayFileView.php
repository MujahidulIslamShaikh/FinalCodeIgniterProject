<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display File Data</title>
    
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    .product-card {
        border-radius: 10px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .product-card img {
        object-fit: cover;
        height: 200px;
    }

    @media (max-width: 576px) {
        .product-card img {
            height: 150px;
        }
    }
</style>

    
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

    <!-- Product Display Section -->
<div class="container mt-5">
    <div class="row g-4">
        <?php foreach ($products as $prod): ?>
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card h-100 shadow-sm product-card">
                    <img src="/uploads/<?= $prod['image'] ?>" class="card-img-top" alt="<?= $prod['name'] ?>">
                    <div class="card-body text-center">
                        <h5 class="card-title"><?= $prod['name'] ?></h5>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>


</body>

</html>