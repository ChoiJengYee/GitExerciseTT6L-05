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
        $sql = "SELECT * FROM admins WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $admin = mysqli_fetch_assoc($result);

        if ($admin) {
            if ($password === $admin['password']) { 
                $_SESSION['admin_logged_in'] = true;
                header("Location: admin_dashboard.php");
                exit();
            } else {
                $message[] = 'Invalid username or password.';
            }
        } else {
            $message[] = 'Invalid username or password.';
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
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap">
    <link rel="stylesheet" href="admin_login.css">
</head>
<body>

<div class="form-container">
    <form action="admin_login.php" method="post">
        <h3>Admin Login</h3>
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






