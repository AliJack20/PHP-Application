<?php
require_once '../../config/database.php';
require_once '../../models/Product.php';
require_once '../../models/Category.php';

$productModel = new Product($pdo);
$categoryModel = new Category($pdo);
$product = $productModel->find($_GET['id']);
$categories = $categoryModel->getAll();
$productCategoryIds = $productModel->getCategoryIds($_GET['id']);
?>

<form method="POST" action="update.php" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $product['id'] ?>">
    <input type="text" name="name" value="<?= $product['name'] ?>" required>
    <input type="number" name="price" value="<?= $product['price'] ?>" step="0.01" required>
    <input type="file" name="image">
    <select name="categories[]" multiple>
        <?php foreach ($categories as $cat): ?>
            <option value="<?= $cat['id'] ?>" <?= in_array($cat['id'], $productCategoryIds) ? 'selected' : '' ?>>
                <?= $cat['name'] ?>
            </option>
        <?php endforeach; ?>
    </select>
    <button type="submit">Update</button>
</form>
