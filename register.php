<?php
include 'config.php';

<<<<<<< HEAD
// Initialize message array
$message = [];

if (isset($_POST['submit'])) {
    // Retrieve and sanitize form input
=======
$message = [];

if (isset($_POST['submit'])) {
>>>>>>> origin/database
    $name = isset($_POST['name']) ? mysqli_real_escape_string($conn, $_POST['name']) : '';
    $email = isset($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : '';
    $password = isset($_POST['password']) ? mysqli_real_escape_string($conn, $_POST['password']) : '';
    $cpassword = isset($_POST['cpassword']) ? mysqli_real_escape_string($conn, $_POST['cpassword']) : '';
    $image = isset($_FILES['image']['name']) ? $_FILES['image']['name'] : '';
<<<<<<< HEAD
    $image_size = isset($_FILES['image']['size']) ? $_FILES['image']['size'] : 0;
    $image_tmp_name = isset($_FILES['image']['tmp_name']) ? $_FILES['image']['tmp_name'] : '';
    $image_folder = 'uploaded_img/' . $image;

    // Debugging output
    echo "Name: $name<br>Email: $email<br>Password: $password<br>Confirm Password: $cpassword<br>Image Name: $image<br>";

    // Check for required fields and file upload
    if (empty($name) || empty($email) || empty($password) || empty($cpassword) || empty($image)) {
        $message[] = 'All fields are required.';
    } else {
        // Check if passwords match
        if ($password != $cpassword) {
            $message[] = 'Passwords do not match!';
        } else {
            // Check file size (max 2MB)
            if ($image_size > 2000000) {
                $message[] = 'Image size is too large (max 2MB).';
            } else {
                // Process file upload
                $image_name = basename($image); // Get file name
                $target_dir = $_SERVER['DOCUMENT_ROOT'] . '/myapp/uploaded_img/'; // Absolute path to destination directory
                $target_path = $target_dir . $image_name; // Full path to target file

                // Create the target directory if it doesn't exist
                if (!file_exists($target_dir)) {
                    mkdir($target_dir, 0777, true); // Create directory with full permissions (0777)
                }

                if (move_uploaded_file($image_tmp_name, $target_path)) {
                    // File upload successful, proceed with database insertion
                    $hashed_password = md5($password); // Use hash function (e.g., md5) for password

                    // Insert user data into database using prepared statement
                    $stmt = mysqli_prepare($conn, "INSERT INTO `users` (name, email, password, image) VALUES (?, ?, ?, ?)");
                    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $hashed_password, $image_name);

                    if (mysqli_stmt_execute($stmt)) {
                        // Registration successful, redirect to login page
=======
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
>>>>>>> origin/database
                        header('location: login.php');
                        exit;
                    } else {
                        $message[] = 'Registration failed!';
                    }

<<<<<<< HEAD
                    mysqli_stmt_close($stmt); // Close statement
                } else {
                    $message[] = 'File upload failed!';
=======
                    mysqli_stmt_close($stmt); 
>>>>>>> origin/database
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
<<<<<<< HEAD
        <input type="password" name="cpassword" placeholder="Confirm password" class="box" required>
        <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png" required>
        <input type="submit" name="submit" value="Register Now" class="btn">
        <p>Already have an account? <a href="login.php">Login now</a></p>
    </form>
</div>

</body>
</html>
=======
        <



>>>>>>> origin/database
