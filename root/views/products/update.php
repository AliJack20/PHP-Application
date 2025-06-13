<?php
require_once '../config/database.php';

$id = $_POST['id'];
$name = $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];
$stock = $_POST['stock'];
$categories = $_POST['categories'] ?? [];

$pdo->beginTransaction();

// Update product
$stmt = $pdo->prepare("UPDATE products SET name = ?, description = ?, price = ?, stock = ? WHERE id = ?");
$stmt->execute([$name, $description, $price, $stock, $id]);

// Remove old categories
$pdo->prepare("DELETE FROM product_categories WHERE product_id = ?")->execute([$id]);

// Add new ones
$stmt = $pdo->prepare("INSERT INTO product_categories (product_id, category_id) VALUES (?, ?)");
foreach ($categories as $categoryId) {
    $stmt->execute([$id, $categoryId]);
}

$pdo->commit();

header("Location: index.php");
exit;
