<?php
function validate_jwt($token, $secret_key) {
    list($header, $payload, $signature) = explode('.', $token);

    $decodedPayload = json_decode(base64_decode(str_replace(['-', '_'], ['+', '/'], $payload)), true);
    if ($decodedPayload['exp'] < time()) {
        return false;
    }

    $validSignature = hash_hmac('sha256', "$header.$payload", $secret_key, true);
    $base64ValidSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($validSignature));

    return $signature === $base64ValidSignature ? $decodedPayload : false;
}


session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    $jwt = $_GET['token'] ?? null;
    if ($jwt) {
        $user = validate_jwt($jwt, 'your_secret_key');
        if ($user) {
            $_SESSION['user'] = $user;
            $_SESSION['loggedin'] = true;
            setcookie("auth_token", $jwt, time() + 3600, "/", "", true, true);
            $first_name = $user['first_name'];
        } else {
            echo "Invalid or expired token.";
        }
    } else {
        echo "Welcome, guest!";
    }
} 
?>