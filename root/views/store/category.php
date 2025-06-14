<?php
require_once '../../models/Category.php';
require_once '../../models/Product.php';
include_once '../layout/header.php';

$categoryId = $_GET['id'] ?? null;
$categoryModel = new Category();
$productModel = new Product();

$category = $categoryModel->getById($categoryId);
$products = $productModel->getByCategory($categoryId);
?>

<?php if (!$category): ?>
    <p>Category not found.</p>
<?php else: ?>
    <h2>Products in: <?= htmlspecialchars($category['name']) ?></h2>

    <div class="product-grid">
        <?php if (count($products) === 0): ?>
            <p>No products in this category.</p>
        <?php else: ?>
            <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <h4><?= htmlspecialchars($product['name']) ?></h4>
                    <p>Price: $<?= htmlspecialchars($product['price']) ?></p>
                    <p>Categories: <?= implode(', ', json_decode($product['categories'], true)) ?></p>
                    <a href="product.php?id=<?= $product['id'] ?>">View Details</a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
<?php endif; ?>

<a href="index.php">← Back to Store</a>

<?php include_once '../layout/footer.php'; ?>
