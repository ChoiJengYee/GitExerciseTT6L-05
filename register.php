<?php
include 'config.php';

$message = [];

if (isset($_POST['submit'])) {
    $name = isset($_POST['name']) ? mysqli_real_escape_string($conn, $_POST['name']) : '';
    $email = isset($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : '';
    $password = isset($_POST['password']) ? mysqli_real_escape_string($conn, $_POST['password']) : '';
    $cpassword = isset($_POST['cpassword']) ? mysqli_real_escape_string($conn, $_POST['cpassword']) : '';
    $image = isset($_FILES['image']['name']) ? $_FILES['image']['name'] : '';
    $image_tmp_name = isset($_FILES['image']['tmp_name']) ? $_FILES['image']['tmp_name'] : '';
    $image_folder = 'uploaded_img/' . $image;

    if (empty($name) || empty($email) || empty($password) || empty($cpassword) || empty($image)) {
        $message[] = 'All fields are required.';
    } else {
        if ($password != $cpassword) {
            $message[] = 'Passwords do not match!';
        } else {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $message[] = 'Invalid email format!';
            } else {
                $image_name = basename($image); 
                $target_dir = $_SERVER['DOCUMENT_ROOT'] . '/myapp/uploaded_img/';
                $target_path = $target_dir . $image_name; 

                if ($_FILES['image']['size'] > 2000000) {
                    $message[] = 'Image size is too large (max 2MB).';
                } elseif (!move_uploaded_file($image_tmp_name, $target_path)) {
                    $message[] = 'File upload failed!';
                } else {
                    // Insert user data into database without hashing password
                    $stmt = mysqli_prepare($conn, "INSERT INTO `users` (name, email, password, image) VALUES (?, ?, ?, ?)");
                    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $password, $image_name);

                    if (mysqli_stmt_execute($stmt)) {
                        header('location: login.php');
                        exit;
                    } else {
                        $message[] = 'Registration failed!';
                    }

                    mysqli_stmt_close($stmt); 
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap">
    <link rel="stylesheet" href="register.css">
</head>
<body>

<div class="form-container">
    <form action="register.php" method="post" enctype="multipart/form-data">
        <h3>Register Now</h3>
        <?php
        if (!empty($message)) {
            foreach ($message as $msg) {
                echo '<div class="message">'.$msg.'</div>';
            }
        }
        ?>
        <input type="text" name="name" placeholder="Enter username" class="box" required>
        <input type="email" name="email" placeholder="Enter email" class="box" required>
        <input type="password" name="password" placeholder="Enter password" class="box" required>
        <



