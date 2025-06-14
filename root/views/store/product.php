<?php
require_once '../../models/Product.php';
include_once '../layout/header.php';

$id = $_GET['id'] ?? null;
$productModel = new Product();
$product = $productModel->getById($id);

if (!$product) {
    echo "<p>Product not found.</p>";
    include_once '../layout/footer.php';
    exit;
}

$categories = json_decode($product['categories'], true);
?>

<h2><?= htmlspecialchars($product['name']) ?></h2>
<p>Price: $<?= htmlspecialchars($product['price']) ?></p>
<p>Description: <?= htmlspecialchars($product['description']) ?></p>
<p>Categories: <?= implode(', ', $categories) ?></p>

<a href="index.php">Back to Store</a>

<?php include_once '../layout/footer.php'; ?>
