<?= $this->extend('/index') ?>


<?= $this->section('contentIndex') ?>




<!-- =========================== User List from API ========================== -->

<div class="container mt-4">
    <a href="/form" class="btn btn-secondary mb-3">Back to Registration Form</a>

    <h2 class="mb-4">User List from API</h2>
    <table class="table table-bordered" id="userTable">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Role</th>
                <th>Contact Number</th>

            </tr>
        </thead>
        <tbody>
            <!-- API data will be inserted here -->

        </tbody>
    </table>
</div>

<script>
    async function loadUsers() {
        try {
            const res = await fetch('/api/users');
            const users = await res.json();

            const tbody = document.querySelector('#userTable tbody');
            tbody.innerHTML = ''; // Clear existing rows

            users.forEach(user => {
                const row = `
            <tr>
              <td>${user.id}</td>
              <td>${user.name}</td>
              <td>${user.role}</td>
              <td>${user.cont_num}</td>
              <td class="text-center">
                            <a href="/edit-user/${user.id}" class="btn btn-sm btn-warning">Edit</a>
                            <a href="javascript:void(0);" onclick="deleteUser(${user.id})" class="btn btn-sm btn-danger">Delete By Api</a>
                        </td>
            </tr>
          `;
                tbody.innerHTML += row;
            });
        } catch (err) {
            console.error('Failed to load users:', err);
        }
    }
    loadUsers(); // Call on page load
    async function deleteUser(id) {
        if (!confirm("Are you sure you want to delete this user?")) return;

        try {
            const response = await fetch(`/api/users/${id}`, {
                method: 'DELETE'
            });

            const result = await response.json();

            if (response.ok) {
                alert(result.message || 'Deleted successfully');
                // Optionally: refresh or redirect
                window.location.reload(); // or window.location.href = '/user-list';
            } else {
                alert(result.message || 'Delete failed');
            }
        } catch (err) {
            alert("Error: " + err.message);
        }
    }
</script>



<?= $this->endSection();  ?>