<?php include 'header.php'; ?>

<?php
require_once 'includes/search_user.php';
$results = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $results = search_users($name, $email, $phone);
}
?>

<div class="form-container">
    <h2>Search User</h2>
    <form action="search_user.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name">

        <label for="email">Email:</label>
        <input type="email" id="email" name="email">

        <label for="phone_number">Phone Number:</label>
        <input type="tel" id="phone_number" name="phone_number">

        <input type="submit" value="Find User">
    </form>
</div>

<div class="container">
    <h2>Search Results:</h2>
    <ul class="user-list">
        <?php if (isset($results) && !empty($results)): ?>        
            <?php foreach ($results as $user): ?>
                <li class="user-item"><?php echo htmlspecialchars($user['first_name']) . ' ' . htmlspecialchars($user['last_name']); ?> - <?php echo htmlspecialchars($user['email']); ?> - <?php echo htmlspecialchars($user['home_address']); ?> - <?php echo htmlspecialchars($user['home_phone']); ?>  - <?php echo htmlspecialchars($user['cell_phone']); ?></li>
            <?php endforeach; ?>            
        <?php elseif (isset($results)): ?>
            <li class="user-item">No users available</li>
        <?php endif; ?>
    </ul>
</div>

<?php include 'footer.php'; ?>