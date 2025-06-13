<form method="POST" action="store.php">
    <input type="text" name="name" placeholder="Category Name" required>
    <select name="parent_id">
        <option value="">No Parent</option>
        <?php
        require_once '../../config/database.php';
        require_once '../../models/Category.php';
        $categoryModel = new Category($pdo);
        $categories = $categoryModel->getAll();
        foreach ($categories as $cat) {
            echo "<option value='{$cat['id']}'>{$cat['name']}</option>";
        }
        ?>
    </select>
    <button type="submit">Create</button>
</form>

