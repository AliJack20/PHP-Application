<?php
require_once '../../config/database.php';
require_once '../../models/Product.php';

$productModel = new Product($pdo);
$productModel->delete($_GET['id']);
header('Location: index.php');
