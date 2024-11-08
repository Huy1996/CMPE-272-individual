<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $home_address = $_POST["home_address"];
    $home_phone = $_POST["home_phone"];
    $cell_phone = $_POST["cell_phone"];
    
    try {
        require_once "db.php";
        $query = "INSERT INTO user(first_name, last_name, email, home_address, home_phone, cell_phone) VALUE(?, ?, ?, ?, ?, ?);";
        
        $stmt = $pdo->prepare($query);
        $stmt->execute([$first_name, $last_name, $email, $home_address, $home_phone, $cell_phone]);

        // Set success message in session
        $_SESSION['success_message'] = "User added successfully!";

        $pdo = null;
        $stmt = null;
        header("Location: ../index.php");
        die();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }

}
else {
    header("Location: ../index.php");
}