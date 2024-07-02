<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: text/html; charset=utf-8');

// Function to get the user's public IP address
function getUserPublicIp()
{
    return $_SERVER['REMOTE_ADDR'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Generate a random combination of 6 characters (letters and numbers)
    $randomString = substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', 6)), 0, 6);

    // Create the signup folder if it doesn't exist
    if (!file_exists('signup')) {
        mkdir('signup');
    }

    // Get the user's public IP address
    $userIp = getUserPublicIp();

    // Create and write to the log file
    $logFileName = 'signup/' . date('Ymd_His') . '_' . $randomString . '.log';
    $logContent = "Username: {$_POST['username']}\nEmail: {$_POST['email']}\nPassword: {$_POST['password']}\nIP: {$userIp}\n";

    if (file_put_contents($logFileName, $logContent) === false) {
        die('Error creating log file.');
    }

    // Redirect to success.php
    header("Location: success.php");
    exit(); // Ensure script stops execution after redirect
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            color: black;
            text-shadow: 0 0 0px #000;
        }
    </style>
</head>
<body>

<form id="signupForm" method="post">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>

    <button type="submit">Submit</button>
</form>

</body>
</html>
