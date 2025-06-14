<!-- views/layout/header.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP CRUD Project</title>
    <link rel="stylesheet" href="/PHP-project/public/style.css"> <!-- optional -->
</head>
<body>
    <header>
        <h1>My Store Admin</h1>
        <nav>
            <a href="/PHP-project/views/categories/index.php">Categories</a> |
            <a href="/PHP-project/views/products/index.php">Products</a> |
            <a href="/PHP-project/views/auth/login.php">Login</a>
        </nav>
    </header>
    <form action="/PHP-project/views/store/search.php" method="get" style="display:inline;">
    <input type="text" name="q" placeholder="Search...">
    <button type="submit">🔍</button>
    </form>

    <main>
