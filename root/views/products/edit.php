<?php
require_once '../config/database.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();

// Get current categories
$stmt = $pdo->prepare("SELECT category_id FROM product_categories WHERE product_id = ?");
$stmt->execute([$id]);
$currentCategories = $stmt->fetchAll(PDO::FETCH_COLUMN);

$allCategories = $pdo->query("SELECT * FROM categories")->fetchAll();
?>

<form method="POST" action="update.php">
    <input type="hidden" name="id" value="<?= $product['id'] ?>">
    <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" required><br>
    <textarea name="description"><?= htmlspecialchars($product['description']) ?></textarea><br>
    <input type="number" name="price" value="<?= $product['price'] ?>" step="0.01" required><br>
    <input type="number" name="stock" value="<?= $product['stock'] ?>" required><br>

    <label>Categories:</label><br>
    <?php foreach ($allCategories as $category): ?>
        <input type="checkbox" name="categories[]" value="<?= $category['id'] ?>"
            <?= in_array($category['id'], $currentCategories) ? 'checked' : '' ?>>
        <?= $category['name'] ?><br>
    <?php endforeach; ?>

    <button type="submit">Update</button>
</form>
