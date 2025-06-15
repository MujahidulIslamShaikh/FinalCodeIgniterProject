<?= $this->extend('/index') ?>
<?= $this->section('contentIndex') ?>

<style>
	.custom-form {
		background-color: #fff;
		border-radius: 10px;
		padding: 30px;
		box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
	}
</style>

<div class="container mt-5">
	<div class="row justify-content-center">
		<!-- Server-Side Update Form -->
		<div class="col-md-6">
			<form class="custom-form" action="/update-user/<?= $user['id'] ?>" method="post">
				<h4 class="mb-4 text-center">Update User (PHP Form)</h4>
				<div class="mb-3">
					<label for="username" class="form-label">Your Username</label>
					<input type="text" name="username" id="username" value="<?= esc($user['name']) ?>" class="form-control" required>
				</div>
				<div class="mb-3">
					<label for="role" class="form-label">Your Role</label>
					<input type="text" name="role" id="role" value="<?= esc($user['role']) ?>" class="form-control" required>
				</div>
				<div class="mb-3">
					<label for="cont_num" class="form-label">Your Contact Number</label>
					<input type="number" name="cont_num" id="cont_num" value="<?= esc($user['cont_num']) ?>" class="form-control" required>
				</div>
				<button type="submit" class="btn btn-primary w-100">Submit</button>
			</form>
		</div>

		<!-- AJAX/Client-Side Update Form -->
		<div class="col-md-6">
			<form class="custom-form" id="updateForm">
				<h4 class="mb-4 text-center">Update User (API / JS)</h4>
				<input type="hidden" id="update_id" value="<?= $user['id'] ?>">

				<div class="mb-3">
					<label for="update_name" class="form-label">New Name</label>
					<input type="text" id="update_name" class="form-control"
						value="<?= esc($user['name']) ?>" placeholder="Enter new name" required>
				</div>

				<div class="mb-3">
					<label for="update_role" class="form-label">New Role</label>
					<input type="text" id="update_role" class="form-control"
						value="<?= esc($user['role']) ?>" placeholder="Enter new role" required>
				</div>

				<div class="mb-3">
					<label for="update_contact" class="form-label">New Contact Number</label>
					<input type="number" id="update_contact" class="form-control"
						value="<?= esc($user['cont_num']) ?>" placeholder="Enter new contact" required>
				</div>

				<button type="submit" class="btn btn-success w-100">Update via JS</button>
				<div id="api_result" class="mt-3"></div>
			</form>
		</div>

	</div>
</div>

<script>
	// JS for PUT
	document.getElementById('updateForm').addEventListener('submit', async function(e) {
		e.preventDefault();

		const id = document.getElementById('update_id').value;
		const data = {
			name: document.getElementById('update_name').value,
			role: document.getElementById('update_role').value,
			cont_num: document.getElementById('update_contact').value
		};


		try {
			const response = await fetch(`/api/users/${id}`, {
				method: 'PUT',
				headers: {
					'Content-Type': 'application/json'
				},
				body: JSON.stringify(data)
			});

			const result = await response.json();

			if (response.ok) {
				alert(result.message || 'Update successful');
				window.location.href = '/user_list'; // ✅ Redirect here
			} else {
				alert(result.message || 'Update failed');
			}
		} catch (err) {
			alert(`Error: ${err.message}`);
		}
	});
</script>




<?= $this->endSection() ?>