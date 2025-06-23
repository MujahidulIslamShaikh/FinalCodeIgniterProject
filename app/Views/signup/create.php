<style>
    .form-container {
        max-width: 500px;
        margin: auto;
        padding: 20px;
        background: #f9f9f9;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    .form-container label {
        font-weight: 600;
        margin-bottom: 5px;
        display: block;
    }

    .form-container input {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border-radius: 6px;
        border: 1px solid #ccc;
        font-size: 15px;
    }

    .form-container button {
        background-color: #007bff;
        color: #fff;
        padding: 10px 15px;
        border: none;
        border-radius: 6px;
        font-size: 16px;
        cursor: pointer;
    }

    .form-container button:hover {
        background-color: #0056b3;
    }

    .form-container a {
        display: inline-block;
        margin-top: 10px;
        font-size: 14px;
    }

    @media (max-width: 576px) {
        .form-container {
            padding: 15px;
        }

        .form-container input, .form-container button {
            font-size: 14px;
        }
    }
</style>




<div class="container mt-4">
    <h2 class="text-center mb-4">Users Table</h2>
    <div class="text-center mb-3"><a href="/">Back to Registration Form</a></div>

    <form class="form-container" action="/signup-user" method="post">
        <label for="name">Your Username</label>
        <input type="text" name="name" id="name" placeholder="Enter username" required>

        <label for="email">Your Email</label>
        <input type="text" name="email" id="email" placeholder="Enter email" required>

        <label for="password">Your Password</label>
        <input type="text" name="password" id="password" placeholder="Enter password" required>

        <button type="submit">Submit</button>

        <?php if (session()->getFlashdata('error')): ?>
            <p style="color:red;"><?= session()->getFlashdata('error') ?></p>
        <?php endif; ?>

        <a href="/login-user">Login here</a>
    </form>
</div>
