<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        .content {
            /* flex: 1; */
            /* padding: 20px; */
        }

        .cursor-pointer {
            cursor: pointer;
        }
    </style>
    
</head>
<?php
        // echo "<pre>";
        // print_r($session->get());
        // echo "</pre>";

?>

<body>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">   
        <div class="container">
            <a class="navbar-brand" href="/">My App</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <!-- <li class="nav-item"><a class="nav-link" href="/CreateNewProduct">CreateNewProduct</a></li> -->
                    <li class="nav-item "><a class="nav-link text-success" href="/ProdCardDisplayList">ProdCardDisplayList</a></li>
                    <li class="nav-item"><a class="nav-link" href="/ProductView">ProductView</a></li>
                    <li class="nav-item"><a class="nav-link" href="/ShowListCategory">categoryListView</a></li>
                    <li class="nav-item"><a class="nav-link" href="/admin/dashboard">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="/signupView">signupView</a></li>


                    <!-- Dropdown Menu for General -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="authDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            General
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="authDropdown">
                            <li><a class="dropdown-item" href="/FilterProductListApiView">Filter Product List</a></li>
                            <li><a class="dropdown-item" href="/ProductListApiView">Product List</a></li>
                            <li><a class="dropdown-item" href="/CreateProductView">Create Product</a></li>
                            <li><a class="dropdown-item" href="/user_list_api">user_list_api</a></li>
                            <li><a class="dropdown-item" href="/form">Form</a></li>
                            <li><a class="dropdown-item" href="/user_list">User List</a></li>
                        </ul>
                    </li>
                    <!-- Dropdown Menu for Auth -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="authDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Account
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="authDropdown">
                            <li><a class="dropdown-item" href="/signup-user">Signup</a></li>
                            <li><a class="dropdown-item" href="/login">Login</a></li>
                            <li><a class="dropdown-item" href="/logout">Logout</a></li>
                        </ul>
                    </li>
                    <li><a href="MyCart"><i class="bi bi-cart3 fs-1 text-success cursor-pointer "></i></a></li>

                    <!-- <li class="nav-item"><a class="nav-link" href="/display-file">display-file</a></li> -->
                </ul>
            </div>
        </div>
    </nav>

    <div class="content">
        <?= $this->renderSection('contentIndex') ?>
    </div>



    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>