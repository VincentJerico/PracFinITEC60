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
        <form method="POST" action="edit.php?id=<?php echo $id; ?>">
            <h2>Edit User</h2>
            <input type="text" name="username" placeholder="Username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
            <input type="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            <input type="number" name="age" placeholder="Age" value="<?php echo htmlspecialchars($user['age']); ?>" required>
            <input type="date" name="dob" placeholder="Date of Birth" value="<?php echo htmlspecialchars($user['date_of_birth']); ?>" required>
            <select name="gender" required>
                <option value="Male" <?php if ($user['gender'] == 'Male') echo 'selected'; ?>>Male</option>
                <option value="Female" <?php if ($user['gender'] == 'Female') echo 'selected'; ?>>Female</option>
                <option value="Other" <?php if ($user['gender'] == 'Other') echo 'selected'; ?>>Other</option>
            </select>
            <button type="submit">Update User</button>
        </form>
    </main>
    <footer>
        <p>Disclaimer: Your disclaimer message goes here.</p>
    </footer>
</body>
</html>
