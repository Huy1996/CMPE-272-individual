<?php
include "../includes/get_most_visit.php";
try {
    $top_visited_products = get_most_visit();
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}


include '../header.php'; 
?>
<div class="container">
    <h2>Most Visited Products</h2>
    <ul>
        <?php if (!empty($top_visited_products)): ?>
            <?php foreach ($top_visited_products as $product): ?>
                <li>
                    <?php echo htmlspecialchars($product['product_name']); ?> 
                    - <?php echo htmlspecialchars($product['visit_count']); ?> visits
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li>No product visits recorded.</li>
        <?php endif; ?>
    </ul>
</div>

<?php include '../footer.php'; ?>   