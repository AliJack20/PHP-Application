<?php
require_once '../../config/database.php';
require_once '../../models/Category.php';

$categoryModel = new Category($pdo);
$categories = $categoryModel->getAll();
?>

<h2>All Categories</h2>
<a href="create.php">Add New Category</a>
<ul>
    <?php foreach ($categories as $cat): ?>
        <li>
            <?= htmlspecialchars($cat['name']) ?> 
            [<a href="edit.php?id=<?= $cat['id'] ?>">Edit</a>]
            [<a href="delete.php?id=<?= $cat['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>]
        </li>
    <?php endforeach; ?>
</ul>
