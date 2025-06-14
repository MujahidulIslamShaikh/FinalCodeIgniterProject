<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>File Upload</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .upload-container {
            background: #fff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 60px auto;
        }

        body {
            background-color: #f8f9fa;
        }

        .upload-container {
            background: #fff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 60px auto;
        }

        .form-label {
            font-weight: 500;
        }

        .btn-upload {
            background-color: #0d6efd;
            color: #fff;
        }

        .btn-upload:hover {
            background-color: #0b5ed7;
        }
    </style>
</head>

<body>
    <?= $this->extend('/admin/dashboard') ?>

    <?= $this->section('content') ?>
    <!-- Upload Form -->
    <div class="container">
        <div class="upload-container">
            <h2 class="mb-4 text-center">📁 Upload Your File</h2>
            <form action="/admin/upload-file" method="post" enctype="multipart/form-data">
                <div class="mb-3">   
                    <label for="name" class="form-label">Enter Image Name</label>
                    <input class="form-control" type="text" name="name" id="name" required>
                </div>
                <div class="mb-3">
                    <label for="file" class="form-label">Choose File</label>
                    <!-- <input class="form-control" type="file" name="image" id="file" required> -->
                    <input type="file" name="images[]" multiple class="form-control" required />

                </div>
                <button type="submit" class="btn btn-upload w-100">Upload</button>
            </form>
        </div>
    </div>
    <?= $this->endSection() ?>
</body>

</html>