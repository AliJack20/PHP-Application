<?php
require_once '../../config/database.php';
require_once '../../models/Category.php';

$categoryModel = new Category($pdo);
$categoryModel->update($_POST['id'], $_POST['name'], $_POST['parent_id']);
header('Location: index.php');
