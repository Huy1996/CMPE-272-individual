<?php 
session_start();
include 'header.php'; 
?>

<?php
$filename = "contacts.txt";
if (file_exists($filename)) {
    $file = fopen($filename, "r");
    while (($line = fgets($file)) !== false) {
        echo "<p>" . htmlspecialchars($line) . "</p>";
    }
    fclose($file);
} else {
    echo "<p>Contact information is not available at this time.</p>";
}
?>

<?php include 'footer.php'; ?>