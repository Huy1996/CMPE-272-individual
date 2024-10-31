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
                <li><a href="/index.php">Home</a></li>
                <li><a href="/about.php">About</a></li>
                <li><a href="/products.php">Products/Services</a></li>
                <li><a href="/news.php">News</a></li>
                <li><a href="/contacts.php">Contact</a></li>
                <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                    <!-- If logged in, show Logout and Secure Section -->
                    <li><a href="/secure.php">Secure</a></li>
                    <li><a href="/logout.php">Logout</a></li>
                <?php else: ?>
                    <!-- If not logged in, show Login -->
                    <li><a href="/login.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main> <!-- Start of the main content -->
