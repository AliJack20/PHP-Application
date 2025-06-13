<?php
require_once '../../config/database.php';
require_once '../../models/Category.php';

$categoryModel = new Category($pdo);
$categoryModel->delete($_GET['id']);
header('Location: index.php');
