<?php
require_once '../models/Product.php';

$product = new Product();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $categories = $_POST['categories'] ?? [];

    $product->create($name, $description, $categories);
    header("Location: ../views/products/index.php");
}
