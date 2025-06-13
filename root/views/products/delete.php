<?php
require_once '../config/database.php';

$id = $_GET['id'];

$pdo->beginTransaction();

// Delete from junction table first
$pdo->prepare("DELETE FROM product_categories WHERE product_id = ?")->execute([$id]);

// Delete product
$pdo->prepare("DELETE FROM products WHERE id = ?")->execute([$id]);

$pdo->commit();

header("Location: index.php");
exit;
