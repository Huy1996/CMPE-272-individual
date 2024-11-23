<?php 
include 'header.php';

// Local function to read users from users.txt
function getLocalUsers() {
    $users = [];
    $file = fopen("users.txt", "r");

    if ($file) {
        while (($line = fgets($file)) !== false) {
            $users[] = trim($line); // Trim removes any extra spaces or newline characters
        }
        fclose($file);
    } else {
        echo "Error: Unable to open users.txt file.";
    }
    return $users;
}

// Function to fetch users from remote company endpoints using CURL
function fetchRemoteUsers($url) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);

    return json_decode($response, true);
}

// Get local users
$local_users = getLocalUsers();

// Fetch users from other companies using their get_users.php endpoint
$company_b_users = fetchRemoteUsers('https://chaudoan.site/chauonline/get_users.php'); // Update with actual URL

?>

<div class="container">
    <h2>Combined List of Users</h2>
    <ul class="user-list">
        <h3>Tech Masters</h3>
        <?php if (!empty($local_users)): ?>
            <?php foreach ($local_users as $user): ?>
                <li class="user-item"><?php echo htmlspecialchars($user); ?></li>
            <?php endforeach; ?>
        <?php else: ?>
            <li class="user-item">No users available</li>
        <?php endif; ?>

        <br>

        <h3>Future Technology</h3>
        <?php if (!empty($company_b_users)): ?>
            <?php foreach ($company_b_users as $user): ?>
                <li class="user-item"><?php echo htmlspecialchars($user); ?></li>
            <?php endforeach; ?>
        <?php else: ?>
            <li class="user-item">No users available</li>
        <?php endif; ?>
    </ul>
</div>

<?php include 'footer.php'; ?>
