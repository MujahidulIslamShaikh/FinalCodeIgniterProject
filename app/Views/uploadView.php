<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>File Upload</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .upload-container {
            background: #fff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 60px auto;
        }
        body {
            background-color: #f8f9fa;
        }

        .upload-container {
            background: #fff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 60px auto;
        }

        .form-label {
            font-weight: 500;
        }

        .btn-upload {
            background-color: #0d6efd;
            color: #fff;
        }

        .btn-upload:hover {
            background-color: #0b5ed7;
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
                    <li class="nav-item"><a class="nav-link" href="/user_list">User List</a></li>
                    <li class="nav-item"><a class="nav-link" href="/signup-user">Signup</a></li>
                    <li class="nav-item"><a class="nav-link" href="/login-user">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="/logout-user">Logout</a></li>
                    <li class="nav-item"><a class="nav-link" href="/display-file">display-file</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Upload Form -->
    <div class="container">
        <div class="upload-container">
            <h2 class="mb-4 text-center">📁 Upload Your File</h2>
            <form action="/upload-file" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label">Enter Image Name</label>
                    <input class="form-control" type="text" name="name" id="name" required>
                </div>
                <div class="mb-3">
                    <label for="file" class="form-label">Choose File</label>
                    <input class="form-control" type="file" name="image" id="file" required>
                </div>
                <button type="submit" class="btn btn-upload w-100">Upload</button>
            </form>
        </div>
    </div>
</body>

</html>