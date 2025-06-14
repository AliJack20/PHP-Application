<?php
require_once 'config/database.php';
require_once 'models/User.php';

$user = new User($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $success = $user->register($_POST['username'], $_POST['email'], $_POST['password']);
    if ($success) {
        header('Location: views/auth/login.php');
        exit;
    } else {
        echo "Registration failed!";
    }
}
