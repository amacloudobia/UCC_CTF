<?php
// src/user.php
$usersFile = __DIR__ . "/database/users.json";

// Define the flag
$flag = "Uguntu{boss_did_you_ever_heard_of_IDOR}";

// Get the user_id from the query string
$userId = $_GET['user_id'] ?? null;

// Check if the user_id is 9
if ($userId == 9) {
    echo "<h1>Congratulations!</h1>";
    echo "<p>Your flag is: <strong>{$flag}</strong></p>";
    exit;
}

// Load the user database
$users = json_decode(file_get_contents($usersFile), true);

// Find the user with the specified ID
$user = array_filter($users, fn($u) => $u['id'] == $userId);
$user = reset($user);

if ($user) {
    echo "<h1>Welcome, {$user['username']}!</h1>";
    echo "<p>Your user ID is: {$user['id']}</p>";
} else {
    echo "<h1>User not found!</h1>";
}
?>
