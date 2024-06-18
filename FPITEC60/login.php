<?php
include('includes/db.php');
include('includes/functions.php');

// Function to set remember me cookie
function set_remember_me_cookie($user_id) {
    $token = bin2hex(random_bytes(16)); // Generate a random token
    $expiry = time() + (30 * 24 * 60 * 60); // Expiry time: 30 days from now
    setcookie('remember_me', $user_id . ':' . $token, $expiry, '/');
}

// Check if the remember me cookie is set and try to automatically login
if(isset($_COOKIE['remember_me']) && !isset($_SESSION['user_id'])) {
    list($user_id, $token) = explode(':', $_COOKIE['remember_me']);
    $user_id = (int)$user_id;
    $user = get_user_by_id($user_id);
    if($user && $user['remember_me_token'] !== null && hash_equals($user['remember_me_token'], $token)) {
        $_SESSION['user_id'] = $user_id;
        header("Location: dashboard.php");
        exit();
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username_or_email = $_POST['username_or_email'];
    $password = $_POST['password'];
    $remember_me = isset($_POST['remember_me']);

    if (login_user($username_or_email, $password)) {
        $user = get_user_by_username_or_email($username_or_email);
        if($user) {
            if($remember_me && $user['remember_me_token'] === null) {
                set_remember_me_cookie($_SESSION['user_id']);
            }
        }
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
    <link rel="stylesheet" href="css/logstyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body>
    <header data-aos="fade-down" data-aos-duration="2000">
        <div class="logo" data-aos="fade-right" data-aos-duration="2900">
            <a href="index.php">
                <img src="./pics/logo/New Project 21 [1A2E243].png" alt="logo">
            </a>
        </div>
    </header>
    <main>
        <div class="container" data-aos="fade-right" data-aos-duration="2900">
            <div class="form-container">
                <form method="POST" action="login.php">
                    <h2>Login</h2>
                    <div class="input-group">
                        <i class="fas fa-user"></i>
                        <input type="text" name="username_or_email" placeholder="Username or Email" required>
                    </div>
                    <div class="input-group">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" id="password" placeholder="Password" required>
                    </div>
                    <div class="input-group">
                        <input type="checkbox" id="togglePassword" onclick="togglePassword()"> Show Password
                    </div>
                    <div class="input-group">
                        <input type="checkbox" name="remember_me"> Remember Me 
                    </div>
                    <button type="submit">Login</button>
                    <p><a href="forgot_password.php">Forgot Password?</a></p>
                    <p>Don't have an account yet? <a href="register.php">Register</a></p>
                </form>
            </div>
        </div>
    </main>
    <footer  class="fade-up">
        <p>All Rights Reserved 2024.</p>
    </footer>
    <script src="js/scripts.js"></script>


    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
    AOS.init();
    </script>
</body>
</html>
