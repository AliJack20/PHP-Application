<?php
require_once '../../models/Product.php';
include_once '../layout/header.php';

$search = $_GET['q'] ?? '';
$productModel = new Product();
$results = [];

if ($search) {
    $results = $productModel->searchByName($search);
}
?>

<h2>Search Results for "<?= htmlspecialchars($search) ?>"</h2>

<form method="GET" action="search.php">
    <input type="text" name="q" value="<?= htmlspecialchars($search) ?>" placeholder="Search products...">
    <button type="submit">Search</button>
</form>

<div class="product-grid">
    <?php if (empty($results)): ?>
        <p>No products found.</p>
    <?php else: ?>
        <?php foreach ($results as $product): ?>
            <div class="product-card">
                <h4><?= htmlspecialchars($product['name']) ?></h4>
                <p>Price: $<?= htmlspecialchars($product['price']) ?></p>
                <p>Categories: <?= implode(', ', json_decode($product['categories'], true)) ?></p>
                <a href="product.php?id=<?= $product['id'] ?>">View Details</a>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<a href="index.php">← Back to Store</a>

<?php include_once '../layout/footer.php'; ?>
