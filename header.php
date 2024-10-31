<?php include_once(dirname(__FILE__)."/config.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechMasters Software Solutions</title>
    <link rel="stylesheet" href="/styles.css"> <!-- Link to your CSS file -->
</head>
<body>
    <header>
        <div class="logo">
            <h1>TechMasters</h1>
        </div>
        <nav>
        <ul>
            <li><a href="<?php echo BASE_URL; ?>/index.php">Home</a></li>
            <li><a href="<?php echo BASE_URL; ?>/about.php">About</a></li>
            <li><a href="<?php echo BASE_URL; ?>/products.php">Products/Services</a></li>
            <li><a href="<?php echo BASE_URL; ?>/news.php">News</a></li>
            <li><a href="<?php echo BASE_URL; ?>/contacts.php">Contact</a></li>
            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                <!-- If logged in, show Secure and Logout links -->
                <li><a href="<?php echo BASE_URL; ?>/secure.php">Secure</a></li>
                <li><a href="<?php echo BASE_URL; ?>/logout.php">Logout</a></li>
            <?php else: ?>
                <!-- If not logged in, show Login link -->
                <li><a href="<?php echo BASE_URL; ?>/login.php">Login</a></li>
            <?php endif; ?>
        </ul>
        </nav>
    </header>
    <main> <!-- Start of the main content -->
