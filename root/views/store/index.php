<?php
require_once(__DIR__ . '/../../config/database.php');
require_once(__DIR__ . '/../../models/Category.php');

$categoryModel = new Category($pdo);
$categories = $categoryModel->getAll();
?>


<!DOCTYPE html>
<html>
<head>
    <title>Store Home</title>
</head>
<body>
    <h1>Storefront</h1>
    <ul>
        <?php foreach ($categories as $cat): ?>
            <li><a href="category.php?id=<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></a></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
