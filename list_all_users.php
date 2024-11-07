<?php
session_start();
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
// $company_c_users = fetchRemoteUsers('https://companyc.com/get_users.php'); // Update with actual URL

// Combine all users into one list
$all_users = array_merge($local_users, $company_b_users ?: [], $company_c_users ?: []); // Use empty array if CURL fails

?>

<div class="container">
    <h2>Combined List of Users</h2>
    <ul class="user-list">
        <?php foreach ($all_users as $user): ?>
            <li class="user-item"><?php echo htmlspecialchars($user); ?></li>
        <?php endforeach; ?>
    </ul>
</div>

<?php include 'footer.php'; ?>
