<?php
function register_user($username, $email, $age, $dob, $gender, $password) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO users (username, email, age, date_of_birth, gender, password) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssisss", $username, $email, $age, $dob, $gender, $password);
    return $stmt->execute();
}

function login_user($username_or_email, $password) {
    global $conn;
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username_or_email, $username_or_email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();
        if (password_verify($password, $hashed_password)) {
            session_start();
            $_SESSION['user_id'] = $id;
            update_time_in($id, $conn); // Update time_in for this user
            return true;
        }
    }
    return false;
}

function get_all_users() {
    global $conn;
    $result = $conn->query("SELECT * FROM users");
    return $result->fetch_all(MYSQLI_ASSOC);
}

function get_user_by_id($id) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function get_user_by_username_or_email($username_or_email) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username_or_email, $username_or_email);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function update_user($id, $username, $email, $age, $dob, $gender) {
    global $conn;
    $stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, age = ?, date_of_birth = ?, gender = ? WHERE id = ?");
    $stmt->bind_param("ssissi", $username, $email, $age, $dob, $gender, $id);
    return $stmt->execute();
}

function delete_user($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}

function update_time_in($user_id, $conn) {
    $stmt = $conn->prepare("UPDATE users SET time_in = NOW() WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
}

function update_time_out($user_id, $conn) {
    $stmt = $conn->prepare("UPDATE users SET time_out = NOW() WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    if ($stmt->execute() === false) {
        error_log("Error updating time_out: " . $stmt->error);
    }
}

// Other function definitions...

function send_password_reset_token($email) {
    global $conn;
    $user = get_user_by_username_or_email($email);
    if (!$user) return false;

    $token = bin2hex(random_bytes(16));
    $expiry = date("Y-m-d H:i:s", strtotime("+1 hour"));

    $stmt = $conn->prepare("UPDATE users SET reset_token = ?, reset_expiry = ? WHERE email = ?");
    $stmt->bind_param("sss", $token, $expiry, $email);
    if ($stmt->execute()) {
        // Send the reset link to the user's email
        $reset_link = "http://yourwebsite.com/reset_password.php?token=$token";
        $subject = "Password Reset Request";
        $message = "Click the link below to reset your password:\n$reset_link";
        mail($email, $subject, $message);
        return true;
    }
    return false;
}

?>
