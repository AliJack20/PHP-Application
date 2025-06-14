<?php
class Category {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM categories");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get a single category by ID
    public function find($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM categories WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Create a new category
    public function create($name, $parentId = null) {
        $stmt = $this->pdo->prepare("INSERT INTO categories (name, parent_id) VALUES (?, ?)");
        $stmt->execute([$name, $parentId]);
    }

    // Update an existing category
    public function update($id, $name, $parentId = null) {
        $stmt = $this->pdo->prepare("UPDATE categories SET name = ?, parent_id = ? WHERE id = ?");
        $stmt->execute([$name, $parentId, $id]);
    }

    // Delete a category
    public function delete($id) {
        // First, remove product associations
        $stmt = $this->pdo->prepare("DELETE FROM product_category WHERE category_id = ?");
        $stmt->execute([$id]);

        // Then delete the category
        $stmt = $this->pdo->prepare("DELETE FROM categories WHERE id = ?");
        $stmt->execute([$id]);
    }

    // Get all categories without a parent (top-level)
    public function getTopLevel() {
        $stmt = $this->pdo->query("SELECT * FROM categories WHERE parent_id IS NULL");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get all subcategories for a given parent category
    public function getSubcategories($parentId) {
        $stmt = $this->pdo->prepare("SELECT * FROM categories WHERE parent_id = ?");
        $stmt->execute([$parentId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
