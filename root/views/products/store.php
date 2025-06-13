<?php
require_once '../config/database.php';

$name = $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];
$stock = $_POST['stock'];
$categories = $_POST['categories'] ?? [];

$pdo->beginTransaction();

// Insert product
$stmt = $pdo->prepare("INSERT INTO products (name, description, price, stock) VALUES (?, ?, ?, ?)");
$stmt->execute([$name, $description, $price, $stock]);
$productId = $pdo->lastInsertId();

// Insert product-category relations
if (!empty($categories)) {
    $stmt = $pdo->prepare("INSERT INTO product_categories (product_id, category_id) VALUES (?, ?)");
    foreach ($categories as $categoryId) {
        $stmt->execute([$productId, $categoryId]);
    }
}

$pdo->commit();

header("Location: index.php");
exit;
