<form method="POST" action="store.php">
    <input type="text" name="name" placeholder="Product Name" required><br>
    <textarea name="description" placeholder="Description"></textarea><br>
    <input type="number" name="price" placeholder="Price" step="0.01" required><br>
    <input type="number" name="stock" placeholder="Stock" required><br>

    <label>Categories:</label><br>
    <?php
    require_once '../config/database.php';
    $stmt = $pdo->query("SELECT * FROM categories");
    while ($row = $stmt->fetch()) {
        echo "<input type='checkbox' name='categories[]' value='{$row['id']}'> {$row['name']}<br>";
    }
    ?>

    <button type="submit">Create</button>
</form>
