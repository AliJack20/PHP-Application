<?php
require_once '../../config/database.php';
require_once '../../models/Category.php';

$categoryModel = new Category($pdo);
$categoryModel->create($_POST['name'], $_POST['parent_id'] ?: null);

header('Location: index.php');
exit;
