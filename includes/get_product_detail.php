<?php
function get_product_details($product_id) {
    // Fetch reviews for the product
    try {
        require "db.php";
        $query = "SELECT * FROM products WHERE product_id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$product_id]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        return $product;
    } catch (PDOException $e) {
        die("Error fetching reviews: " . $e->getMessage());
    }
}
