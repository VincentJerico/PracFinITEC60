<?php
session_start();
include('includes/db.php');
include('includes/functions.php');

if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit();
}

$id = $_GET['id'];

if (delete_user($id)) {
    header("Location: dashboard.php");
    exit();
} else {
    echo "Error deleting user.";
}
?>
