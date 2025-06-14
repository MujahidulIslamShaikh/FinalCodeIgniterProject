<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Image Upload</title>

    <!-- ✅ Bootstrap 5 CDN -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet" />

    <!-- ✅ Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 50px;
        }

        .upload-form-container {
            max-width: 500px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-label {
            font-weight: 600;
        }

        .btn-primary {
            width: 100%;
        }
    </style>
</head>

<body>
    <?= $this->extend('/admin/dashboard') ?>

    <?= $this->section('content') ?>
    <div class="container">
        <div class="upload-form-container">
            <h3 class="mb-4 text-center">Upload Images</h3>
            <form action="<?= base_url('/admin/mult-image-upload') ?>" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="imgName" class="form-label">Image Name</label>
                    <input type="text" name="imgName" id="imgName" class="form-control" required />
                </div>
                <div class="mb-3">
                    <label for="images" class="form-label">Select Images</label>
                    <input type="file" name="images[]" multiple class="form-control" required />
                </div>
                <button type="submit" class="btn btn-primary">Upload</button>
            </form>
        </div>
    </div>
    <?= $this->endSection() ?>


</body>

</html>