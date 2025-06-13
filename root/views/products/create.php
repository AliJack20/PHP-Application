<?php
require_once '../../config/database.php';
require_once '../../models/Category.php';
?>

<form method="POST" action="store.php" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="Product Name" required>
    <input type="number" name="price" placeholder="Price" required step="0.01">
    <input type="file" name="image" required>
    <select name="categories[]" multiple>
        <?php
        $categoryModel = new Category($pdo);
        foreach ($categoryModel->getAll() as $cat) {
            echo "<option value='{$cat['id']}'>{$cat['name']}</option>";
        }
        ?>
    </select>
    <button type="submit">Save</button>
</form>
