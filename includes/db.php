<?php

$dsn = "mysql:host=localhost:3306;dbname=xwnwrqmy_WPAEC";
$dbusername = "nguyen";
$dbpassword = "nguyen.duong";

try {
    $pdo = new PDO($dsn, $dbusername, $dbpassword);
    // $pdo = new PDO("mysql:host=localhost:3306;dbname=tech_masters", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
