<?php
// login.php

$username = $_POST['username'];
$password = $_POST['password'];

if (is_array($username) && is_array($password) && $username[0] === "admin" && $password[0] === "admin") {
  // Login successful
  echo "Flag: " . file_get_contents("flag.txt");
} else {
  // Login failed
  echo "Invalid username or password";
}
?>

