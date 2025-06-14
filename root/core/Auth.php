<?php
class Auth {
    public static function check() {
        return isset($_SESSION['user']);
    }

    public static function user() {
        return $_SESSION['user'] ?? null;
    }

    public static function requireLogin() {
        if (!self::check()) {
            header('Location: ../auth/login.php');
            exit;
        }
    }
}
