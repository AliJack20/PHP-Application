<?php
session_start();
require_once 'config/database.php';
require_once 'models/User.php';

$user = new User($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $loggedInUser = $user->login($_POST['email'], $_POST['password']);
    if ($loggedInUser) {
        $_SESSION['user'] = $loggedInUser;
        header('Location: views/products/index.php');
        exit;
    } else {
        echo "Login failed!";
    }
}
