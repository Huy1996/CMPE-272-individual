<?php
// read the list of users from the text file
$users = [];
$file = fopen('../users.txt', "r");

if ($file) {
    while (($line = fgets($file)) !== false) {
        $users[] = trim($line); // Trim to remove any extra spaces or newline characters
    }
    fclose($file);
} else {
    // Return an error message in JSON if th file can't be opened
    header('Content-Type: application/json');
    echo json_encode(["error" => "Unable to open file."]);
}

// Output the list of users in JSON format
header('Content-Type: application/json');
echo json_encode($users, JSON_PRETTY_PRINT);