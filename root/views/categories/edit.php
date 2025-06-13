<?php
require_once '../../config/database.php';
require_once '../../models/Category.php';

$categoryModel = new Category($pdo);
$category = $categoryModel->find($_GET['id']);
$categories = $categoryModel->getAllExcept($_GET['id']);
?>

<form method="POST" action="update.php">
    <input type="hidden" name="id" value="<?= $category['id'] ?>">
    <input type="text" name="name" value="<?= $category['name'] ?>" required>
    <select name="parent_id">
        <option value="">No Parent</option>
        <?php foreach ($categories as $cat): ?>
            <option value="<?= $cat['id'] ?>" <?= $cat['id'] == $category['parent_id'] ? 'selected' : '' ?>>
                <?= $cat['name'] ?>
            </option>
        <?php endforeach; ?>
    </select>
    <button type="submit">Update</button>
</form>
