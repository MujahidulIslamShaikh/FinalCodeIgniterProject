<?= $this->extend('/index') ?>
<?= $this->section('contentIndex') ?>

<style>
    
    .custom-style {
        background-color: #f5f5f5;
        padding: 20px;
        border-radius: 8px;
    }


</style>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center mb-4">Login Here</h2>

            <form action="/loginAction" method="post">
                <div class="mb-3">
                    <label for="email" class="form-label">Your Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
                </div>
                <div class="mb-3">
                    <label for="pass" class="form-label">Your Password</label>
                    <input type="password" class="form-control" id="pass" name="pass" required>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>

                <div class="mt-3 text-center">
                    <a href="/signup-user">Signup here...</a> |
                    <a href="/forgot">Forgot Password?</a>
                </div>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger mt-3"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success mt-3"><?= session()->getFlashdata('success') ?></div>
                <?php endif; ?>
            </form>

            <div class="mt-4 text-center">
                <a href="/Noor" class="btn btn-outline-secondary">Login User List</a>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
