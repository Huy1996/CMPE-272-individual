<?php
function get_product_details($product_id) {
    // Fetch reviews for the product
    try {
        require "db.php";

        // Increment the visit count
        $update_query = "UPDATE products SET visit_count = visit_count + 1 WHERE product_id = ?";
        $update_stmt = $pdo->prepare($update_query);
        $update_stmt->execute([$product_id]);

        // Fetch the product details
        $query = "SELECT * FROM products WHERE product_id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$product_id]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        return $product;
    } catch (PDOException $e) {
        throw new Exception("Error fetching reviews: " . $e->getMessage(), 0, $e);
    }
}

