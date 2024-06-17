<?php
include('includes/db.php');
include('includes/functions.php');

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $password = $_POST['password'];
        if (reset_password($token, $password)) {
            $message = "Your password has been reset successfully.";
        } else {
            $error_message = "Failed to reset password. The token may be invalid or expired.";
        }
    }
} else {
    header("Location: forgot_password.php");
    exit();
}

function reset_password($token, $password) {
    global $conn;
    $stmt = $conn->prepare("SELECT id FROM users WHERE reset_token = ? AND reset_expiry > NOW()");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id);
        $stmt->fetch();
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $conn->prepare("UPDATE users SET password = ?, reset_token = NULL, reset_expiry = NULL WHERE id = ?");
        $stmt->bind_param("si", $hashed_password, $user_id);
        return $stmt->execute();
    }
    return false;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1 class="logo">Logo</h1>
    </header>
    <main>
        <form method="POST" action="reset_password.php?token=<?php echo htmlspecialchars($token); ?>">
            <h2>Reset Password</h2>
            <input type="password" name="password" placeholder="Enter new password" required>
            <button type="submit">Reset Password</button>
            <?php if (isset($message)) echo "<p>$message</p>"; ?>
            <?php if (isset($error_message)) echo "<p>$error_message</p>"; ?>
        </form>
    </main>
    <footer>
        <p>Disclaimer: Your disclaimer message goes here.</p>
    </footer>
</body>
</html>
