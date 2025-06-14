<?php
require_once '../models/Category.php';

$category = new Category();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $parent_id = $_POST['parent_id'] ?? null;

    $category->create($name, $parent_id);
    header("Location: ../views/categories/index.php");
}
