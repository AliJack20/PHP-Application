<?php
require_once '../config/database.php';
$stmt = $pdo->query("SELECT * FROM categories");
$categories = $stmt->fetchAll();
?>

<h2>Categories</h2>
<a href="create.php">Create New Category</a>
<ul>
    <?php foreach ($categories as $category): ?>
        <li>
            <?= htmlspecialchars($category['name']) ?> 
            (<a href="edit.php?id=<?= $category['id'] ?>">Edit</a> |
            <a href="delete.php?id=<?= $category['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>)
        </li>
    <?php endforeach; ?>
</ul>
