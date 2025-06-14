<?php
require_once(__DIR__ . '/../../config/database.php');
require_once(__DIR__ . '/../../models/Category.php');
require_once(__DIR__ . '/../../models/Product.php');

$categoryModel = new Category($pdo); // ✅ Pass $pdo here
$productModel = new Product($pdo);   // ✅ Also required if using Product

$categoryId = $_GET['id'] ?? null;
if (!$categoryId) {
    die("Category ID is missing.");
}

// Get category name (optional)
$category = $categoryModel->getById($categoryId);

// Get products in this category
$products = $productModel->getByCategory($categoryId);
?>

<h1>Products in <?= htmlspecialchars($category['name'] ?? 'Unknown') ?></h1>

<?php if ($products): ?>
    <ul>
        <?php foreach ($products as $product): ?>
            <li>
                <strong><?= htmlspecialchars($product['name']) ?></strong><br>
                <?= htmlspecialchars($product['description']) ?><br>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No products found in this category.</p>
<?php endif; ?>
