<?= $this->extend('/index') ?>


<?= $this->section('contentIndex') ?>

<style>

</style>

  <!-- <?php echo session('user'); ?> -->
  <div class="container mt-5">
    <div class="row g-4 justify-content-center">

      <!-- First Form -->
      <div class="col-md-6">
        <div class="card shadow-sm">
          <div class="card-body">
            <h4 class="card-title mb-4 text-center">User Information</h4>
            <form action="/submit-form" method="post">
              <div class="mb-3">
                <label for="username1" class="form-label">Your Username</label>
                <input type="text" class="form-control" id="username1" name="username" placeholder="e.g. johndoe" required>
              </div>
              <div class="mb-3">
                <label for="role1" class="form-label">Your Role</label>
                <input type="text" class="form-control" id="role1" name="role" placeholder="e.g. admin or user" required>
              </div>
              <div class="mb-3">
                <label for="cont_num1" class="form-label">Your Contact Number</label>
                <input type="number" class="form-control" id="cont_num1" name="cont_num" placeholder="e.g. 9876543210" required>
              </div>
              <button type="submit" class="btn btn-primary w-100">Submit</button>
            </form>
          </div>
        </div>
      </div>

      <!-- Second Form (API Form) -->
      <div class="col-md-6">
        <div class="card shadow-sm">
          <div class="card-body">
            <h4 class="card-title mb-4 text-center">User Information API</h4>
            <form id="userForm">
              <div class="mb-3">
                <label for="name" class="form-label">Your Username</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="e.g. johndoe" required>
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
            <div id="result" class="mt-3"></div>

          </div>
        </div>
      </div>

    </div>
  </div>

  <script>
    document.getElementById('userForm').addEventListener('submit', async function(e) {
      e.preventDefault();

      const form = e.target;
      const data = {
        name: form.name.value,
        role: form.role.value,
        cont_num: form.cont_num.value
      };

      try {
        const response = await fetch('/api/users', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(data)
        });

        const result = await response.json();

        const alertBox = document.createElement('div');
        alertBox.className = `alert alert-${response.ok ? 'success' : 'danger'}`;
        alertBox.textContent = result.message || 'Failed';
        document.getElementById('result').innerHTML = '';
        document.getElementById('result').appendChild(alertBox);

        if (response.ok) form.reset();

        // ✅ Auto-hide after 3 seconds
        setTimeout(() => {
          alertBox.remove();
        }, 3000);

      } catch (err) {
        const alertBox = document.createElement('div');
        alertBox.className = 'alert alert-danger';
        alertBox.textContent = `Error: ${err.message}`;
        document.getElementById('result').innerHTML = '';
        document.getElementById('result').appendChild(alertBox);

        setTimeout(() => {
          alertBox.remove();
        }, 3000);
      }
    });
  </script>

<?= $this->endSection() ?>


