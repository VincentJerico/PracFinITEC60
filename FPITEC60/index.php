<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <link rel="stylesheet" href="css/indexstyle.css">
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
        <div class="container" data-aos="fade-right" data-aos-duration="2000">
            <div class="welcome">
                <h2 id="welcome">Welcome to User Dashboard!</h2>
                <p id="greetings">Your gateway to seamless navigation and effortless management. Dive into your personalized space where you can track, organize, and optimize your online experience. Get ready to explore a world of convenience right at your fingertips. <br>Let's make every click count!</p>
            </div>
            <div class="get-started">
                <a href="register.php" class="button">Get Started</a>
            </div>
        </div>
    </main>
    <footer class="fade-up">
        <p>All Rights Reserved 2024.</p>
    </footer>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
    AOS.init();
    </script>
</body>
</html>
