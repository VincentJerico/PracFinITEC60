<?php
session_start();
include('includes/db.php');
include('includes/functions.php');

if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit();
}

$id = $_GET['id'];
$user = get_user_by_id($id);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    
    if (update_user($id, $username, $email, $age, $dob, $gender)) {
        header("Location: dashboard.php");
        exit();
    } else {
        $error_message = "User update failed. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="css/editstyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body>
    <header data-aos="fade-down" data-aos-duration="2000">
        <div class="logo" data-aos="fade-right" data-aos-duration="2900">
            <a href="dashboard.php">
                <img src="./pics/logo/New Project 21 [1A2E243].png" alt="logo">
            </a>
        </div>
        <nav>
            <a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Log Out</a>
        </nav>
    </header>
    <main data-aos="fade-right" data-aos-duration="2900">
        <div class="form-container">
            <form method="POST" action="edit.php?id=<?php echo $id; ?>">
                <h2>Edit User</h2>
                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="username" placeholder="Username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
                </div>
                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                </div>
                <div class="input-group">
                    <i class="fas fa-calendar-alt"></i>
                    <input type="number" name="age" placeholder="Age" value="<?php echo htmlspecialchars($user['age']); ?>" required>
                </div>
                <div class="input-group">
                    <i class="fas fa-birthday-cake"></i>
                    <input type="date" name="dob" placeholder="Date of Birth" value="<?php echo htmlspecialchars($user['date_of_birth']); ?>" required>
                </div>
                <div class="input-group">
                    <i class="fas fa-venus-mars"></i>
                    <select name="gender" required>
                        <option value="" disabled>Select Gender</option>
                        <option value="Male" <?php if ($user['gender'] == 'Male') echo 'selected'; ?>>Male</option>
                        <option value="Female" <?php if ($user['gender'] == 'Female') echo 'selected'; ?>>Female</option>
                        <option value="Other" <?php if ($user['gender'] == 'Other') echo 'selected'; ?>>Other</option>
                    </select>
                </div>
                <button type="submit">Update User</button>
            </form>
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
