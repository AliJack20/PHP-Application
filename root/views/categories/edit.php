<?php
require_once '../config/database.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM categories WHERE id = ?");
$stmt->execute([$id]);
$category = $stmt->fetch();

$allCategories = $pdo->query("SELECT * FROM categories WHERE id != $id")->fetchAll();
?>

<form method="POST" action="update.php">
    <input type="hidden" name="id" value="<?= $category['id'] ?>">
    
    <input type="text" name="name" value="<?= htmlspecialchars($category['name']) ?>" required>
    
    <select name="parent_id">
        <option value="">No Parent</option>
        <?php foreach ($allCategories as $row): ?>
            <option value="<?= $row['id'] ?>" <?= $category['parent_id'] == $row['id'] ? 'selected' : '' ?>>
                <?= $row['name'] ?>
            </option>
        <?php endforeach; ?>
    </select>
    
    <button type="submit">Update</button>
</form>
