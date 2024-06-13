<?php
include('includes/db.php');
include('includes/functions.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username_or_email = $_POST['username_or_email'];
    $password = $_POST['password'];
    
    if (login_user($username_or_email, $password)) {
        header("Location: dashboard.php");
        exit();
    } else {
        $error_message = "Login failed. Please check your credentials.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1 class="logo">Logo</h1>
    </header>
    <main>
        <form method="POST" action="login.php">
            <h2>Login</h2>
            <input type="text" name="username_or_email" placeholder="Username or Email" required>
            <input type="password" name="password" id="password" placeholder="Password" required>
            <input type="checkbox" id="togglePassword" onclick="togglePassword()"> Show Password
            <button type="submit">Login</button>
            <p>Don't have an account yet? <a href="register.php">Register</a></p>
        </form>
    </main>
    <footer>
        <p>Disclaimer: Your disclaimer message goes here.</p>
    </footer>
    <script src="js/scripts.js"></script>
</body>
</html>