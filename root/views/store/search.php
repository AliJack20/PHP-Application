<?php
require_once(__DIR__ . '/../../config/database.php');
require_once(__DIR__ . '/../../models/Product.php');

$productModel = new Product($pdo);

$query = $_GET['query'] ?? '';
$searchResults = $productModel->search($query);
?>

<h1>Search Results for: <?= htmlspecialchars($query) ?></h1>

<?php if ($searchResults): ?>
    <ul>
        <?php foreach ($searchResults as $product): ?>
            <li>
                <strong><?= htmlspecialchars($product['name']) ?></strong><br>
                <?= htmlspecialchars($product['description']) ?><br>
                <em>Categories: <?= htmlspecialchars($product['categories']) ?></em>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No products found.</p>
<?php endif; ?>

