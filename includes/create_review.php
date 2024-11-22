<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $redirect = $_POST['redirect'];
    $product_id = $_POST["product_id"];
    $user_id = $_POST["user_id"];
    $first_name = $_POST["first_name"];
    $rating = $_POST["rating"];
    $review_text = $_POST["review_text"];
    
    try {
        require_once "db.php";
        $query = "INSERT INTO reviews (product_id, user_id, first_name, rating, review_text) VALUES (?, ?, ?, ?, ?)";
        
        $stmt = $pdo->prepare($query);
        $stmt->execute([$product_id, $user_id, $first_name, $rating, $review_text]);

        // Set success message in session
        $_SESSION['success_message'] = "User added successfully!";

        $pdo = null;
        $stmt = null;
        header('Location:'.$redirect);
        die();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }

}
else {
    header('Location:'.$redirect);
    die();
}