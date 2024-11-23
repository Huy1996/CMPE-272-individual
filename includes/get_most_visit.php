<?php
function get_most_visit() {
    // Fetch reviews for the product
    try {
        require "db.php";

        // Fetch the top 5 most visited products
        $query = "
        SELECT *
        FROM products 
        ORDER BY visit_count DESC 
        LIMIT 5
        ";
        $stmt = $pdo->query($query);
        $top_visited_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $top_visited_products;
    } catch (PDOException $e) {
        die("Error fetching reviews: " . $e->getMessage());
    }
}

