<?php
require_once '../config/database.php';

$id = $_POST['id'];
$name = $_POST['name'];
$parent_id = $_POST['parent_id'] ?: null;

$stmt = $pdo->prepare("UPDATE categories SET name = ?, parent_id = ? WHERE id = ?");
$stmt->execute([$name, $parent_id, $id]);

header("Location: index.php");
exit;
