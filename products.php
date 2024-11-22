<?php 
include 'header.php'; 

// Database connection
try {
    $conn = new PDO("mysql:host=localhost:3306;dbname=tech_masters", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Fetch all products from the database
$stmt = $conn->prepare("SELECT * FROM products");
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
    <h2>Our Products and Services</h2>
    <ul>
        <?php foreach ($products as $product): ?>
            <li><a href="products/product_details.php?id=<?php echo $product['product_id']; ?>">
                <?php echo htmlspecialchars($product['product_name']); ?>
            </a></li>
        <?php endforeach; ?>
    </ul>

    <h3>Recently Visited Products</h3>
    <ul>
        <?php
        if (isset($_COOKIE['recently_visited'])) {
            $recently_visited = unserialize($_COOKIE['recently_visited']);
            
            if (!empty($recently_visited)) {
                // Fetch details of recently visited products from the database
                $placeholders = implode(',', array_fill(0, count($recently_visited), '?'));
                $stmt = $conn->prepare("SELECT * FROM products WHERE product_id IN ($placeholders)");
                $stmt->execute($recently_visited);
                $recently_visited_products = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($recently_visited_products as $product) {
                    echo "<li><a href='product_details.php?id=" . $product['product_id'] . "'>" . 
                         htmlspecialchars($product['product_name']) . 
                         "</a></li>";
                }
            } else {
                echo "<li>No recently visited products.</li>";
            }
        } else {
            echo "<li>No recently visited products.</li>";
        }
        ?>
    </ul>
    <p><a href="products/most_visited.php">View Most Visited Products</a></p>
</div>

<?php include 'footer.php'; ?>
