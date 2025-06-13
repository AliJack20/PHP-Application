<?php
require_once '../config/database.php';

$stmt = $pdo->query("SELECT * FROM products");
$products = $stmt->fetchAll();
?>

<h2>Products</h2>
<a href="create.php">Create New Product</a>
<ul>
    <?php foreach ($products as $product): ?>
        <li>
            <?= htmlspecialchars($product['name']) ?> - $<?= $product['price'] ?> 
            (<a href="edit.php?id=<?= $product['id'] ?>">Edit</a> |
             <a href="delete.php?id=<?= $product['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>)
        </li>
    <?php endforeach; ?>
</ul>
