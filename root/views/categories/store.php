<?php
require_once '../config/database.php';

$name = $_POST['name'];
$parent_id = $_POST['parent_id'] ?: null;

$sql = "INSERT INTO categories (name, parent_id) VALUES (?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$name, $parent_id]);

header('Location: index.php');
