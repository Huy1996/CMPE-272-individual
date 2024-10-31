<?php
session_start();
include '../header.php'; 
?>
    <h2>Most Visited Products</h3>
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

<?php include '../footer.php'; ?>   