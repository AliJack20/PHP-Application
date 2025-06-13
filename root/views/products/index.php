<?php
require_once '../../config/database.php';
require_once '../../models/Product.php';

$productModel = new Product($pdo);
$products = $productModel->getAllWithCategories();
?>

<a href="create.php">Create Product</a>
<table>
    <tr><th>Name</th><th>Price</th><th>Categories</th><th>Actions</th></tr>
    <?php foreach ($products as $product): ?>
    <tr>
        <td><?= $product['name'] ?></td>
        <td><?= $product['price'] ?></td>
        <td><?= implode(', ', json_decode($product['categories'])) ?></td>
        <td>
            <a href="edit.php?id=<?= $product['id'] ?>">Edit</a>
            <a href="delete.php?id=<?= $product['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
