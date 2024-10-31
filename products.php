<?php 
session_start();
include 'header.php'; 
?>

    <h2>Our Products and Services</h2>
    <ul>
        <li><a href="products/website_develop.php">Custom Software Development</a></li>
        <li>IT Consulting</li>
        <li>Cloud Solutions</li>
    </ul>

    <h3>Recently Visited Products</h3>
    <ul>
        <?php
        if (isset($_COOKIE['recently_visited'])) {
            $recently_visisted = unserialize($_COOKIE['recently_visited']);
            foreach ($recently_visisted as $product) {
                echo "<li>$product</li>";
            }
        } else {
            echo "<li>No recently visisted products.</li>";
        }
        ?>
    </ul>

    <h3>Most Visited Products</h3>
    <ul>
        <?php
        if (isset($_COOKIE['product_visits'])) {
            $product_visits = unserialize($_COOKIE['product_visits']);
            arsort($product_visits);
            $top_visited = array_slice($product_visits, 0, 5);
            foreach ($top_visited as $product => $count) {
                echo "<li>$product - $count visits</li>";
            }
        } else {
            echo "<li>No product visits recorded.</li>";
        }
        ?>
    </ul>


<?php include 'footer.php'; ?>