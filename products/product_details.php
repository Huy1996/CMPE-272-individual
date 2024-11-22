<?php

// Database connection
try {
    $conn = new PDO("mysql:host=localhost:3306;dbname=tech_masters", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Get product ID from query parameters
$product_id = $_GET['id'] ?? null;
if (!$product_id) {
    die("Product not found.");
}

// Fetch product details from the database
$stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
$stmt->execute([$product_id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    die("Product not found.");
}

// Product details
$product_name = $product['product_name'];
$product_description = $product['product_description'];
$product_image = $product['product_image'];

// Track recently visited products using cookies
if (isset($_COOKIE['recently_visited'])) {
    $recently_visited = unserialize($_COOKIE['recently_visited']);
} else {
    $recently_visited = [];
}

// Update recently visited products
if (!in_array($product_id, $recently_visited)) {
    array_unshift($recently_visited, $product_id);
    if (count($recently_visited) > 5) {
        array_pop($recently_visited);
    }
    setcookie('recently_visited', serialize($recently_visited), time() + (86400 * 30), "/");
}

// Track most visited products using cookies
if (isset($_COOKIE['product_visits'])) {
    $product_visits = unserialize($_COOKIE['product_visits']);
} else {
    $product_visits = [];
}
$product_visits[$product_id] = ($product_visits[$product_id] ?? 0) + 1;
setcookie('product_visits', serialize($product_visits), time() + (86400 * 30), "/");

// // Handle review submission
// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user'])) {
//     $user = $_SESSION['user'];
//     $rating = $_POST['rating'];
//     $review_text = $_POST['review_text'];

//     $stmt = $conn->prepare("INSERT INTO reviews (product_id, user_id, first_name, rating, review_text) VALUES (?, ?, ?, ?)");
//     $stmt->execute([$product_id, $user['id'], $user['first_name'], $rating, $review_text]);

//     echo "<p>Thank you for your review!</p>";
// }

// Fetch reviews for the product
try {
    $stmt = $conn->prepare("
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
    ");
    $stmt->execute([$product_id]);
    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching reviews: " . $e->getMessage());
}

include '../header.php'; 
$user = $_SESSION['user'];
?>

<div class="container">
    <h2><?php echo htmlspecialchars($product_name); ?></h2>
    <img src="<?php echo htmlspecialchars($product_image); ?>" alt="<?php echo htmlspecialchars($product_name); ?>" style="width:300px;height:auto;">
    <p><?php echo htmlspecialchars($product_description); ?></p>

    <!-- Review Form -->
    <?php if (isset($_SESSION['loggedin']) || $_SESSION['loggedin'] === true): ?>
        <h3>Leave a Review</h3>
        <form action="includes/create_review.php" method="POST">
            <input type="hidden" name="redirect" value="<?php echo htmlspecialchars($_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']); ?>">
            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product_id); ?>">
            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user["user_id"]); ?>">
            <input type="hidden" name="first_name" value="<?php echo htmlspecialchars($user["first_name"]); ?>">
            <label for="rating">Rating (1-5):</label>
            <select name="rating" id="rating" required>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            <br>
            <label for="review_text">Your Review:</label>
            <textarea name="review_text" id="review_text" rows="4" required></textarea>
            <br>
            <button type="submit" class="btn">Submit Review</button>
        </form>
    <?php else: ?>
        <p><a href="../login.php">Log in</a> to leave a review.</p>
    <?php endif; ?>

    <!-- Display Reviews -->
    <h3>Reviews</h3>
    <?php if ($reviews): ?>
        <ul>
            <?php foreach ($reviews as $review): ?>
                <li>
                    <strong><?php echo htmlspecialchars($review['first_name']); ?></strong> 
                    (Rating: <?php echo $review['rating']; ?>/5)<br>
                    <?php echo htmlspecialchars($review['review_text']); ?><br>
                    <small><?php echo htmlspecialchars($review['created_at']); ?></small>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No reviews yet.</p>
    <?php endif; ?>

    <a href="products.php">Back to Products</a>
</div>

<?php include '../footer.php'; ?>
