<?php

include 'config.php';
session_start();

if(isset($_POST['submit'])){

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

    $select = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'")or die ('query failed');

    if(mysqli_num_rows($select) > 0){
        $message[] = 'user already exist';       
        $row = mysqli_fetch_assoc($select);
        $_SESSION['user_id'] = $row['id'];
        header('location:home.php');

    }else{
        $message[] = 'incorrect email or password!';   
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap">
    <link rel="stylesheet" href="register.css">
</head>
<body>

<div class="form-container">
    <form action="login.php" method="post" enctype="multipart/form-data">
        <h3>Login now</h3>
        <?php
        if(isset($message)){
            foreach($message as $msg){
                echo '<div class ="message">'.$msg.'</div>';
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

