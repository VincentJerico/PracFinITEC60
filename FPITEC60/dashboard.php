<?php
session_start();
include('includes/db.php');
include('includes/functions.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$users = get_all_users();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1 class="logo">Logo</h1>
        <nav>
            <a href="about.php">About Us</a>
            <a href="logout.php">Log Out</a>
        </nav>
    </header>
    <main>
        <h2>User Dashboard</h2>
        <table>
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Age</th>
                    <th>Date of Birth</th>
                    <th>Gender</th>
                    <th>Time In</th>
                    <th>Time Out</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td><?php echo htmlspecialchars($user['age']); ?></td>
                    <td><?php echo htmlspecialchars($user['date_of_birth']); ?></td>
                    <td><?php echo htmlspecialchars($user['gender']); ?></td>
                    <td><?php echo htmlspecialchars($user['time_in']); ?></td>
                    <td><?php echo htmlspecialchars($user['time_out']); ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $user['id']; ?>">Edit</a>
                        <a href="delete.php?id=<?php echo $user['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="add.php" class="button">Add User</a>
    </main>
    <footer>
        <p>Disclaimer: Your disclaimer message goes here.</p>
    </footer>
</body>
</html>
