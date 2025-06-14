<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Product Table</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<style>
		.table-container {
			margin-top: 40px;
			background-color: #fff;
			padding: 25px;
			border-radius: 8px;
			box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
		}

		img {
			object-fit: cover;
			border-radius: 5px;
		}
	</style>
</head>

<body>
	<?= $this->extend('/admin/dashboard') ?>
	<?= $this->section('content') ?>

	<div class="container table-container">
		<h2 class="mb-4">📦 Uploaded Products</h2>
		<a href="/admin/upload-file" class="btn btn-secondary mb-3">ADD PROUDCTS</a>

		<div class="table-responsive">
			<table class="table table-bordered table-striped align-middle text-center">
				<thead class="table-light">
					<tr>
						<th>#</th>
						<th>Product Name</th>
						<th>Product Image</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($products as $product): ?>
						<tr>
							<td><?= esc($product['id']) ?></td>
							<td><?= esc($product['name']) ?></td>
							<td>
								<img src="<?= base_url('uploads/' . esc($product['image'])) ?>" alt="imgProduct" width="100" height="80">
							</td>
							<td>
								<a href="/admin/edit-product/<?= $product['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
								<a href="/admin/delete-product/<?= $product['id'] ?>" 
									onclick="return confirm('Delete this product?')" class="btn btn-danger btn-sm">Delete</a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>

	<?= $this->endSection() ?>
</body>

</html>