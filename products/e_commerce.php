<?php
session_start();
// Product details
$product_name = "E-commerce Solutions";
$product_description = "We provide end-to-end e-commerce solutions, creating fully customized platforms to boost sales and enhance customer experience.";
$product_image = "./images/E-commerce-Solutions.jpg";

// Track recently visited products using cookies
if (isset($_COOKIE['recently_visited'])) {
    $recently_visited = unserialize($_COOKIE['recently_visited']);
} else {
    $recently_visited = [];
}

// Update recently visited products
if (!in_array($product_name, $recently_visited)) {
    array_unshift($recently_visited, $product_name);
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
$product_visits[$product_name] = ($product_visits[$product_name] ?? 0) + 1;
setcookie('product_visits', serialize($product_visits), time() + (86400 * 30), "/");

include 'header.php'; 
?>

<div class="container">
    <h2><?php echo $product_name; ?></h2>
    <img src="<?php echo $product_image; ?>" alt="<?php echo $product_name; ?>" style="width:300px;height:auto;">
    <p><?php echo $product_description; ?></p>
    <a href="../products.php">Back to Products</a>
</div>

<?php include 'footer.php'; ?>

