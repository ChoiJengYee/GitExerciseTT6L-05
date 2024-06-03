<?php
session_start();
include 'config.php'; 

if (isset($_POST['create_admin'])) {
    $username = isset($_POST['username']) ? mysqli_real_escape_string($conn, $_POST['username']) : '';
    $password = isset($_POST['password']) ? mysqli_real_escape_string($conn, $_POST['password']) : '';

    if (!empty($username) && !empty($password)) {
        $sql = "INSERT INTO admins (username, password) VALUES (?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $username, $password);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $message = "New admin created successfully.";
    } else {
        $message = "Please fill in all fields.";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin Dashboard</title>
    <link rel="stylesheet" href="super_admin_dashboard.css">
</head>
<body>
    <div class="container">
        <h2>Super Admin Dashboard</h2>
        <?php
        if (isset($message)) {
            echo '<div class="message">'.$message.'</div>';
        }
        ?>
        <form action="super_admin_dashboard.php" method="post">
            <input type="text" name="username" placeholder="Enter new admin username" required>
            <input type="password" name="password" placeholder="Enter new admin password" required>
            <input type="submit" name="create_admin" value="Create Admin" class="btn">
        </form>
        <a href="logout.php" class="btn logout">Logout</a>
    </div>
</body>
</html>




