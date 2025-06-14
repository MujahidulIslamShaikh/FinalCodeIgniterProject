<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<!-- <script src="https://cdn.tailwindcss.com"></script> -->
	 <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	

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
	<!-- <?php  echo session('user'); ?> -->
	   <div class="container mt-5">
    <div class="card shadow-sm mx-auto" style="max-width: 500px;">
      <div class="card-body">
        <h4 class="card-title mb-4 text-center">User Information</h4>
        <form action="/submit-form" method="post">
          <div class="mb-3">
            <label for="username" class="form-label">Your Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="e.g. johndoe" required>
          </div>

          <div class="mb-3">
            <label for="role" class="form-label">Your Role</label>
            <input type="text" class="form-control" id="role" name="role" placeholder="e.g. admin or user" required>
          </div>

          <div class="mb-3">
            <label for="cont_num" class="form-label">Your Contact Number</label>
            <input type="number" class="form-control" id="cont_num" name="cont_num" placeholder="e.g. 9876543210" required>
          </div>

          <button type="submit" class="btn btn-primary w-100">Submit</button>
        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>