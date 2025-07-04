<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            display: flex;
            min-height: 100vh;
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f6f9;
        }

        .sidebar {
            width: 250px;
            background-color: #212529;
            color: white;
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
            overflow-x: hidden;
        }

        .sidebar.collapsed {
            width: 70px;
        }

        .sidebar h4 {
            text-align: center;
            margin-bottom: 30px;
            font-weight: 600;
            font-size: 1.4rem;
            transition: opacity 0.3s;
            margin-top: 18px;
        }

        .sidebar.collapsed h4 {
            opacity: 0;
            pointer-events: none;
        }

        .sidebar a {
            padding: 12px 20px;
            color: #adb5bd;
            text-decoration: none;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.2s ease;
            white-space: nowrap;
        }

        .sidebar a:hover {
            background-color: #343a40;
            color: #fff;
        }

        .sidebar a i {
            font-size: 1.1rem;
        }

        .sidebar.collapsed a span {
            display: none;
        }

        .topbar {
            background: #fff;
            padding: 12px 20px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .content {
            flex-grow: 1;
            padding: 0;
            display: flex;
            flex-direction: column;
        }

        .main-content {
            padding: 20px;
        }

        .toggle-btn {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #212529;
        }

        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                z-index: 1000;
                height: 100vh;
                left: -250px;
            }

            .sidebar.show {
                left: 0;
            }

            .sidebar.collapsed {
                left: -70px;
            }

            .content {
                margin-left: 0;
            }
        }
    </style>

</head>

<body>
    <div class="sidebar" id="sidebar">
        <h4><i class="bi bi-person-circle me-1"></i> <span>Admin</span></h4>
        
        <a href="/"><i class="bi bi-house-door-fill"></i> <span>Page</span></a>
        <a href="/admin/dashboard"><i class="bi bi-speedometer2"></i> <span>Dashboard</span></a>
        <a href="/admin/upload-file"><i class="bi bi-upload"></i> <span>Upload Product</span></a>
        <a href="/admin/prod-action"><i class="bi bi-pencil-square"></i> <span>Product Actions</span></a>
        <a href="/admin/mult-image-upload"><i class="bi bi-images"></i> <span>Multi Image Upload</span></a>
        <a href="/admin/product_list"><i class="bi bi-plus-square-fill"></i> <span>Add Product</span></a>
        <!-- <a href="/admin/logout"><i class="bi bi-box-arrow-right text-danger"></i> <span>Logout</span></a> -->
        <a href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
            <i class="bi bi-box-arrow-right text-danger"></i> <span>Logout</span>
        </a>

    </div>

    <div class="content">
        <div class="topbar">
            <button class="toggle-btn" onclick="toggleSidebar()">
                <i class="bi bi-list"></i>
            </button>
            <h5 class="mb-0">Welcome, Admin</h5>
        </div>
        <div class="main-content">
            <?= $this->renderSection('content') ?>
        </div>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');

        function toggleSidebar() {
            sidebar.classList.toggle('collapsed');
        }
    </script>
    <?php
    echo view('/components/autologout');
    ?>

    <!-- Logout Confirmation Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="logoutModalLabel">Confirm Logout</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <i class="bi bi-exclamation-triangle-fill text-danger fs-2"></i>
                    <p class="mt-3">Are you sure you want to log out?</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a href="/admin/logout" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </div>
    </div>



</body>

</html>