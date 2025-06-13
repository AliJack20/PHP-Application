<?php
class Product {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Get all products with their associated category names
    public function getAllWithCategories() {
        $stmt = $this->pdo->query("
            SELECT 
                p.id, p.name, p.price, p.image,
                JSON_ARRAYAGG(c.name) as categories
            FROM products p
            LEFT JOIN product_category pc ON p.id = pc.product_id
            LEFT JOIN categories c ON pc.category_id = c.id
            GROUP BY p.id
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Find a single product by ID
    public function find($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get category IDs associated with a product
    public function getCategoryIds($productId) {
        $stmt = $this->pdo->prepare("SELECT category_id FROM product_category WHERE product_id = ?");
        $stmt->execute([$productId]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    // Create a new product and attach categories
    public function create($name, $price, $image, $categoryIds = []) {
        $stmt = $this->pdo->prepare("INSERT INTO products (name, price, image) VALUES (?, ?, ?)");
        $stmt->execute([$name, $price, $image]);
        $productId = $this->pdo->lastInsertId();

        $this->attachCategories($productId, $categoryIds);
    }

    // Update an existing product
    public function update($id, $name, $price, $image = '', $categoryIds = []) {
        if ($image) {
            $stmt = $this->pdo->prepare("UPDATE products SET name = ?, price = ?, image = ? WHERE id = ?");
            $stmt->execute([$name, $price, $image, $id]);
        } else {
            $stmt = $this->pdo->prepare("UPDATE products SET name = ?, price = ? WHERE id = ?");
            $stmt->execute([$name, $price, $id]);
        }

        $this->detachCategories($id);
        $this->attachCategories($id, $categoryIds);
    }

    // Delete a product and its category associations
    public function delete($id) {
        $this->detachCategories($id);
        $stmt = $this->pdo->prepare("DELETE FROM products WHERE id = ?");
        $stmt->execute([$id]);
    }

    // Attach multiple categories to a product
    private function attachCategories($productId, $categoryIds) {
        $stmt = $this->pdo->prepare("INSERT INTO product_category (product_id, category_id) VALUES (?, ?)");
        foreach ($categoryIds as $categoryId) {
            $stmt->execute([$productId, $categoryId]);
        }
    }

    // Detach all categories from a product
    private function detachCategories($productId) {
        $stmt = $this->pdo->prepare("DELETE FROM product_category WHERE product_id = ?");
        $stmt->execute([$productId]);
    }
}
?>
