<?php
session_start();
include 'config.php'; 

$message = [];

if (isset($_POST['login'])) {
    $username = isset($_POST['username']) ? mysqli_real_escape_string($conn, $_POST['username']) : '';
    $password = isset($_POST['password']) ? mysqli_real_escape_string($conn, $_POST['password']) : '';

    if (empty($username) || empty($password)) {
        $message[] = 'All fields are required.';
    } else {
        // Prepare and execute the SQL query
        $sql = "SELECT * FROM super_admins WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result->num_rows > 0) {
            // Fetch the row from the result set
            $admin = $result->fetch_assoc();

            // Verify the password
            if ($password === $admin['password']) {
                $_SESSION['super_admin_logged_in'] = true;
                header("Location: super_admin_dashboard.php");
                exit();
            } else {
                $message[] = 'Invalid password.';
            }
        } else {
            $message[] = 'Invalid username.';
        }

        mysqli_stmt_close($stmt);
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
    <title>Super Admin Login</title>
    <link rel="stylesheet" href="super_admin_login.css">
</head>
<body>

<div class="form-container">
    <form action="super_admin_login.php" method="post">
        <h3>Super Admin Login</h3>
        <?php
        if (!empty($message)) {
            foreach ($message as $msg) {
                echo '<div class="message">'.$msg.'</div>';
            }
        }
        ?>
        <input type="text" name="username" placeholder="Enter username" class="box" required>
        <input type="password" name="password" placeholder="Enter password" class="box" required>
        <input type="submit" name="login" value="Login" class="btn">
    </form>
</div>

</body>
</html>
