<?php
function search_users($name = '', $email = '', $phone = '') {
    try {
        require_once "db.php";
        // Build the SQL query based on input fields
        $query = "SELECT * FROM user WHERE 1=1";
        $params = [];

        if (!empty($name)) {
            $query .= " AND (first_name LIKE ? OR last_name LIKE ?)";
            $params[] = "%" . $name . "%";
            $params[] = "%" . $name . "%";
        }
        if (!empty($email)) {
            $query .= " AND email LIKE ?";
            $params[] = "%" . $email . "%";
        }
        if (!empty($phone)) {
            $query .= " AND (home_phone LIKE ? OR cell_phone LIKE ?)";
            $params[] = "%" . $phone . "%";
            $params[] = "%" . $phone . "%";
        }

        // Execute the query
        $stmt = $pdo->prepare($query);
        $stmt->execute($params);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
            } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}