<?php
session_start();
// Check if the user is already logged in, if yes then redirect to the secure page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
    header("Location: secure.php");
    exit;
}


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $file = fopen("password.txt", "r");
    $verified = false;

    while(!feof($file)){
        $line = fgets($file);
        $line = chop($line);
        list($username_list, $password_list) = explode(",", $line);

        if ($username === $username_list && $password === $password_list) {
            // If they match, set the session and redirect to the secure page
            $_SESSION['loggedin'] = true;
            $verified = true;
            break;
        }
    }

    fclose($file);

    if ($verified) {
        header("Location: secure.php");
        exit;   
    }
    else {
        $error = "Invalid username or password.";
    }
}
?>
<?php 
include(dirname(__FILE__)."/config.php");
include BASE_URL .'/header.php'; 
?>

<div class="login-container">
        <h2>Admin Login</h2>
        <?php if (isset($error)) { echo "<p style='color: red;'>$error</p>"; } ?>
        <form method="post" action="login.php">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>

<?php include BASE_URL .'/footer.php'; ?>