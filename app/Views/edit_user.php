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
		<div class="col-md-6">
			<form class="custom-form" action="/update-user/<?= $user['id'] ?>" method="post">
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
	</div>
</div>



<?= $this->endSection() ?>
