<!DOCTYPE html>
<html>
<head>
    <title><?= esc($title) ?></title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        h1 { color: darkblue; }
    </style>
</head>
<body>
    <h1><?= esc($title) ?></h1>
    <p>Username: <?= esc($data['username']) ?></p>
</body>
</html>
