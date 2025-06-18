<?= $this->extend('/index') ?>


<?= $this->section('contentIndex') ?>




<!-- =========================== User List from API ========================== -->
<div class="container mt-4">
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
</script>



<?= $this->endSection();  ?>