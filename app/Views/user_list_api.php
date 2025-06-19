<?= $this->extend('/index') ?>


<?= $this->section('contentIndex') ?>





<!-- =========================== User List from API ========================== -->

<div class="container mt-4">
	<!-- <a href="/form" class="btn btn-secondary mb-3">Back to Registration Form</a> -->
	<button class="btn btn-secondary mb-3" data-bs-toggle="modal" data-bs-target="#createUserModal">
		Create User by Popup
	</button>


	<h2 class="mb-4">User List from API</h2>

	<!-- Bootstrap Modal for Creating User -->
	<div class="modal fade" id="createUserModal" tabindex="-1">
		<div class="modal-dialog">
			<form id="createUserForm" class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Create User</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
				<div class="modal-body">
					<input type="text" id="name" class="form-control mb-2" placeholder="Name" required>
					<input type="text" id="role" class="form-control mb-2" placeholder="Role" required>
					<input type="text" id="cont_num" class="form-control mb-2" placeholder="Contact Number" required>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success">Create</button>
				</div>
			</form>
		</div>
	</div>
	<!-- Bootstrap Modal for Editing User -->
	<!-- Edit User Modal -->
	<div class="modal fade" id="editUserModal" tabindex="-1">
		<div class="modal-dialog">
			<form id="editUserForm" class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Edit User</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
				<div class="modal-body">
					<input type="hidden" id="edit_id">
					<input type="text" id="edit_name" class="form-control mb-2" placeholder="Name" required>
					<input type="text" id="edit_role" class="form-control mb-2" placeholder="Role" required>
					<input type="text" id="edit_cont_num" class="form-control mb-2" placeholder="Contact Number" required>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Update</button>
				</div>
			</form>
		</div>
	</div>


	<!-- ==================================================================== -->
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
	// ============= Create user form =====================
	document.getElementById('createUserForm').addEventListener('submit', async function(e) {
		e.preventDefault();

		const data = {
			name: document.getElementById('name').value,
			role: document.getElementById('role').value,
			cont_num: document.getElementById('cont_num').value
		};

		try {
			const res = await fetch('/api/users', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json'
				},
				body: JSON.stringify(data)
			});

			const result = await res.json();

			if (res.ok) {
				alert('User created successfully!');
				bootstrap.Modal.getInstance(document.getElementById('createUserModal')).hide();
				document.getElementById('createUserForm').reset();
				loadUsers(); // refresh list
			} else {
				alert(result.message || 'Failed to create user');
			}
		} catch (err) {
			console.error('Error:', err);
			alert('Something went wrong');
		}
	});
	// ============= Edit user form =====================
	function openEditModal(id, name, role, cont_num) {
		document.getElementById('edit_id').value = id;
		document.getElementById('edit_name').value = name;
		document.getElementById('edit_role').value = role;
		document.getElementById('edit_cont_num').value = cont_num;

		const modal = new bootstrap.Modal(document.getElementById('editUserModal'));
		modal.show();
	}
	document.getElementById('editUserForm').addEventListener('submit', async function(e) {
		e.preventDefault();

		const id = document.getElementById('edit_id').value;

		const data = {
			name: document.getElementById('edit_name').value,
			role: document.getElementById('edit_role').value,
			cont_num: document.getElementById('edit_cont_num').value
		};

		try {
			const res = await fetch(`/api/users/${id}`, {
				method: 'PUT',
				headers: {
					'Content-Type': 'application/json'
				},
				body: JSON.stringify(data)
			});

			const result = await res.json();

			if (res.ok) {
				alert('User updated successfully!');
				bootstrap.Modal.getInstance(document.getElementById('editUserModal')).hide();
				loadUsers(); // Refresh table
			} else {
				alert(result.message || 'Update failed');
			}
		} catch (err) {
			console.error('Error:', err);
			alert('Something went wrong');
		}
	});








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
    						<button class="btn btn-sm btn-warning" onclick="openEditModal(${user.id}, '${user.name}', '${user.role}', '${user.cont_num}')">Edit</button>
    						<button class="btn btn-sm btn-danger" onclick="deleteUser(${user.id})">Delete</button>
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