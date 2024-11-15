<?php
// src/register.php
$usersFile = __DIR__ . "/database/users.json";

// Load the user database
$users = json_decode(file_get_contents($usersFile), true);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Generate a new user ID
    $newUserId = count($users) + 1;

    // Add the new user to the database
    $users[] = [
        'id' => $newUserId,
        'username' => $username,
        'password' => $password
    ];
    file_put_contents($usersFile, json_encode($users));

    // Redirect to the user page
    header("Location: user.php?user_id=$newUserId");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
        }
        form {
            display: inline-block;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Register</h1>
    <form method="POST">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <button type="submit">Register</button>
    </form>
</body>
</html>
