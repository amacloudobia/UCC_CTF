<?php
// login.php

$username = $_POST['username'];
$password = $_POST['password'];

// Fetch the flag from an environment variable
$flag = getenv('FLAG');

if (is_array($username) && is_array($password) && $username[0] === "admin" && $password[0] === "admin") {
    // Login successful
    echo "Flag:uguntu{php_type_confusion_with_array_you're_insecure} " . htmlspecialchars($flag);
} else {
    // Login failed
    echo "Invalid username or password";
}
?>
