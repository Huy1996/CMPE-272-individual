<?php
function get_review($product_id) {
    // Fetch reviews for the product
    try {
        require "db.php";
        $query = "
            SELECT 
                review_id, 
                first_name, 
                rating, 
                review_text, 
                created_at 
            FROM 
                reviews 
            WHERE 
                product_id = ? 
            ORDER BY 
                created_at DESC
        ";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$product_id]);
        $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $reviews;
    } catch (PDOException $e) {
        die("Error fetching reviews: " . $e->getMessage());
    }
}