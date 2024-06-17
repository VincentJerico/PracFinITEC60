<?php
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
        header("Location: login.php");
        exit();
    } else {
        $error_message = "Registration failed. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/regstyle.css">
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
    <main data-aos="fade-right" data-aos-duration="2900">
        <div class="form-container">
            <form method="POST" action="register.php">
                <h2>Register</h2>
                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="username" placeholder="Username" required>
                </div>
                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="input-group">
                    <i class="fas fa-hashtag"></i>
                    <input type="number" name="age" placeholder="Age" required>
                </div>
                <div class="input-group">
                    <i class="fas fa-calendar-alt"></i>
                    <input type="date" name="dob" placeholder="Date of Birth" required>
                </div>
                <div class="input-group">
                    <i class="fas fa-venus-mars"></i>
                    <select name="gender" required>
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" id="password" placeholder="Password" required>
                </div>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required>
                </div>
                <div class="input-group">
                    <input type="checkbox" id="togglePassword" onclick="togglePassword()"> Show Password
                </div>
                <button type="submit">Register</button>
                <p>Already have an account? <a href="login.php">Login</a></p>
            </form>
        </div>
    </main>
    <footer>
        <p>All Rights Reserved 2024.</p>
    </footer>
    <script src="js/scripts.js"></script>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
    AOS.init();
    </script>
</body>
</html>
