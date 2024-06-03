<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin_dashboard.css">
</head>
<body>
    <div class="container">
        <h2>Admin Dashboard</h2>
        <div class="buttons">
            <a href="entry.html" class="button">Manage Buildings and Faculties</a>
            <a href="manage_user.php" class="button">Manage Users</a>
            <a href="event.html" class="button">Manage Events</a>
            <a href="manage_feedback.php" class="button">Manage Feedback</a>
            <a href="logout.php" class="button logout">Logout</a>
        </div>
    </div>
</body>
</html>


