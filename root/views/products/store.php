<?php
require_once '../../config/database.php';
require_once '../../models/Product.php';

$imagePath = '';
if ($_FILES['image']['name']) {
    $imagePath = 'uploads/' . basename($_FILES['image']['name']);
    move_uploaded_file($_FILES['image']['tmp_name'], "../../$imagePath");
}

$productModel = new Product($pdo);
$productModel->create($_POST['name'], $_POST['price'], $imagePath, $_POST['categories']);
header('Location: index.php');
