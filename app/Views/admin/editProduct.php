<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Product</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .upload-container {
            background: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            max-width: 550px;
            margin: 60px auto;
        }

        img.preview {
            margin-top: 10px;
            max-width: 150px;
            height: auto;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid #dee2e6;
        }


        .form-label {
            font-weight: 500;
        }

        .btn-update {
            background-color: #0d6efd;
            color: #fff;
        }

        .btn-update:hover {
            background-color: #0b5ed7;
        }
    </style>
</head>

<body>
    <?= $this->extend('/admin/dashboard') ?>
    <?= $this->section('content') ?>

    <div class="container">
        <div class="upload-container">
            <h3 class="mb-4 text-center">✏️ Edit Product</h3>
            <form action="/admin/edit-product/<?= $product['id'] ?>" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label">Product Name</label>
                    <input type="text" name="name" id="name" value="<?= esc($product['name']) ?>" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Current Image</label><br>
                    <img width="100px" src="<?= base_url('uploads/' . esc($product['image'])) ?>" class="preview" alt="Product Image">
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Change Image (optional)</label>
                    <input type="file" name="image" id="image" class="form-control">
                </div>

                <button type="submit" class="btn btn-update w-100">Update Product</button>
            </form>
        </div>
    </div>

    <?= $this->endSection() ?>
</body>

</html>