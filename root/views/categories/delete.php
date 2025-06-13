<?php
require_once '../config/database.php';

$id = $_GET['id'];

// Optional: check for child categories and prevent delete if necessary

$stmt = $pdo->prepare("DELETE FROM categories WHERE id = ?");
$stmt->execute([$id]);

header("Location: index.php");
exit;
