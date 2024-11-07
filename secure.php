<?php
session_start();

// Check if the user is logged in, if not redirect to the login page
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Initialize the users array
$users = [];

// Read the list of users from the text file
$file = fopen("users.txt", "r");
if ($file) {
    while (($line = fgets($file)) !== false) {
        $users[] = trim($line); // Trim removes any extra spaces or newline characters
    }
    fclose($file);
} else {
    echo "Error: Unable to open users.txt file.";
}
?>

<?php include 'header.php'; ?>
<div class="container">
    <h2 class="title">Current Users of the Website</h2>
    <ul class="user-list">
        <?php foreach ($users as $user): ?>
            <li class="user-item"><?php echo htmlspecialchars($user); ?></li>
        <?php endforeach; ?>
    </ul>
</div>
<?php include 'footer.php'; ?>
