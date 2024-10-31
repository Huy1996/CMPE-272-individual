<?php 
session_start();
include(dirname(__FILE__)."/config.php");
include BASE_URL .'/header.php'; 
?>
    <h2>Our Products and Services</h2>
    <ul>
        <li><a href="products/website_develop.php">Website Development</a></li>
        <li><a href="products/mobile_app_development.php">Mobile App Development</a></li>
        <li><a href="products/data_analytic.php">Data Analytics</a></li>
        <li><a href="products/cybersecurity.php">Cybersecurity Solutions</a></li>
        <li><a href="products/cloud.php">Cloud Migration Services</a></li>
        <li><a href="products/ai_ml.php">AI and Machine Learning Integration</a></li>
        <li><a href="products/blockchain.php">Blockchain Solutions</a></li>
        <li><a href="products/it.php">IT Infrastructure Management</a></li>
        <li><a href="products/erp.php">Enterprise Resource Planning (ERP) Systems</a></li>
        <li><a href="products/e_commerce.php">E-commerce Solutions</a></li>
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
    <p><a href="/products/most_visited.php">View Most Visited Products</a></p>
<?php include BASE_URL .'/footer.php'; ?>