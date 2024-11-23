<?php
include "../includes/get_most_visit.php";
header('Content-Type: application/json');
try {
    // Fetch the top 5 most visited products
    $top_visited_products = get_most_visit();

    // Respond with the data in JSON format
    echo json_encode([
        "status" => "success",
        "data" => $top_visited_products
    ]);
} catch (Exception $e) {
    // Handle any exceptions
    http_response_code(500);
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}
