<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f4f6f9;
        }

        .login-container {
            max-width: 400px;
            margin: 80px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .form-title {
            font-weight: 600;
            margin-bottom: 25px;
        }

        .form-link {
            display: block;
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="login-container">
            <h2 class="form-title text-center">Login here...</h2>

            <form action="/admin/login" method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Admin@123" required />
                </div>
                <div class="mb-3">
                    <label for="pass" class="form-label">Your Password</label>
                    <input type="password" name="pass" id="pass" class="form-control" required />
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>

                <a class="form-link" href="/signup-user">Signup here...</a>
                <a class="form-link" href="/forgot">Forgot Password?</a>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger mt-3"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success mt-3"><?= session()->getFlashdata('success') ?></div>
                <?php endif; ?>
            </form>
                    
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>