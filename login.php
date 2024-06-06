<?php

include 'config.php';
session_start();

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    if ($stmt = $conn->prepare("SELECT id FROM `users` WHERE email = ? AND password = ?")) {
        $stmt->bind_param("ss", $email, $pass);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($user_id);
            $stmt->fetch();
            $_SESSION['user_id'] = $user_id;
            session_regenerate_id(true);  
            header('Location: home.php');
            exit();
        } else {
            $message[] = 'Incorrect email or password!';
        }

        $stmt->close();
    } else {
        $message[] = 'Database query failed!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap">
    <link rel="stylesheet" href="register.css">
</head>
<body>

<div class="form-container">
    <form action="login.php" method="post" enctype="multipart/form-data">
        <h3>Login now</h3>
        <?php
        if (isset($message)) {
            foreach ($message as $msg) {
                echo '<div class="message">' . htmlspecialchars($msg) . '</div>';
            }
        }
        ?>
        <input type="email" name="email" placeholder="Enter email" class="box" required>
        <input type="password" name="password" placeholder="Enter password" class="box" required>
        <input type="submit" name="submit" value="Login now" class="btn">
        <p>Don't have an account? <a href="register.php">Register now</a></p>
    </form>
</div>

</body>
</html>



