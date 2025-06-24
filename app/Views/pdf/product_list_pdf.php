<!DOCTYPE html>
<html>
<head>
    <title>Product List PDF</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 6px; text-align: left; }
        th { background-color: #198754; color: white; }
        h2 { color: #198754; }
    </style>
</head>
<body>
    <h2>📦 Product List</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Details</th>
                <th>Category</th>
                <th>Brand</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $p): ?>
            <tr>
                <td><?= $p['Prodid'] ?></td>
                <td><?= $p['ProdName'] ?></td>
                <td><?= $p['details'] ?></td>
                <td><?= $p['category'] ?></td>
                <td><?= $p['brand'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
