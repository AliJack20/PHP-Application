<?php
require_once '../core/Session.php';
require_once '../core/Functions.php';
require_once '../models/User.php';

Session::start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = sanitize($_POST['email']);
    $password = $_POST['password'];

    $userModel = new User();
    $user = $userModel->findByEmail($email);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        redirect('../views/dashboard.php');
    } else {
        echo "Invalid login credentials";
    }
}
