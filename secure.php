<?php
session_start();

// Check if the user is logged in, if not redirect to the login page
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// List of users
$users = ["Mary Smith", "John Wang", "Alex Bington", "John Doe"]
?>

<?php 
include(dirname(__FILE__)."/config.php");
include BASE_PATH .'/header.php'; 
?>
<div class="container">
        <h2>Current Users of the Website</h2>
        <ul>
            <?php foreach ($users as $user) {
                echo "<li>$user</li>";
            } ?>
        </ul>
    </div>
<?php include BASE_PATH .'/footer.php'; ?>
