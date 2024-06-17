<?php
session_start();
include('includes/db.php');
include('includes/functions.php');

// Check if the database connection is valid
if ($conn === false) {
    die("Error: Could not connect to the database.");
}

if(isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    update_time_out($user_id, $conn); // Update time_out for this user
}

// Destroy session
session_unset();
session_destroy();

// Remove "remember me" cookie
if(isset($_COOKIE['remember_me'])) {
    unset($_COOKIE['remember_me']);
    setcookie('remember_me', null, -1, '/');
}

header("Location: login.php");
exit();
?>
