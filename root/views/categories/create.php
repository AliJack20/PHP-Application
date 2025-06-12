<form method="POST" action="store.php">
    <input type="text" name="name" placeholder="Category Name" required>
    <select name="parent_id">
        <option value="">No Parent</option>
        <option value="1">Electronics</option>
        <option value="2">Books</option>
        <option value="3">Clothes</option>
        <!-- Loop through existing categories -->
        <?php
        require_once '../config/database.php';
        $stmt = $pdo->query("SELECT * FROM categories");
        while ($row = $stmt->fetch()) {
            echo "<option value='{$row['id']}'>{$row['name']}</option>";
        }
        ?>
    </select>
    <button type="submit">Create</button>
</form>
