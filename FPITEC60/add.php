<?php
session_start();
include('includes/db.php');
include('includes/functions.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    
    if (register_user($username, $email, $age, $dob, $gender, $password)) {
        header("Location: dashboard.php");
        exit();
    } else {
        $error_message = "User creation failed. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1 class="logo">Logo</h1>
        <nav>
            <a href="dashboard.php">Dashboard</a>
            <a href="logout.php">Log Out</a>
        </nav>
    </header>
    <main>
        <form method="POST" action="add.php">
            <h2>Add User</h2>
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="number" name="age" placeholder="Age" required>
            <input type="date" name="dob" placeholder="Date of Birth" required>
            <select name="gender" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>
            <input type="password" name="password" placeholder="Password" required>
            <input type="checkbox" onclick="togglePassword()"> Show Password
            <button type="submit">Add User</button>
        </form>
    </main>
    <footer>
        <p>Disclaimer: Your disclaimer message goes here.</p>
    </footer>
    <script src="js/scripts.js"></script>
</body>
</html>
