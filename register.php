<?php
include 'config.php'; // Assuming this file contains your database connection
session_start();

$message = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
    $image = $_FILES['image']['name'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_size = $_FILES['image']['size'];
    $image_folder = 'uploaded_img/' . $image;

    if (empty($name) || empty($email) || empty($password) || empty($cpassword) || empty($image)) {
        $message[] = 'All fields are required.';
    } else {
        if ($password !== $cpassword) {
            $message[] = 'Passwords do not match!';
        } else {
            if ($image_size > 2000000) {
                $message[] = 'Image size is too large (max 2MB).';
            } else {
                // Directory to save uploaded images
                $target_dir = 'uploaded_img/';

                // Move uploaded file to target directory
                if (move_uploaded_file($image_tmp_name, $target_dir . $image)) {
                    // Prepare and execute SQL statement to insert user data into database
                    $stmt = $conn->prepare("INSERT INTO `users` (name, email, password, image) VALUES (?, ?, ?, ?)");
                    $stmt->bind_param("ssss", $name, $email, $password, $image);

                    if ($stmt->execute()) {
                        // Registration successful, redirect to login page
                        header('Location: login.php');
                        exit();
                    } else {
                        $message[] = 'Registration failed!';
                    }

                    $stmt->close();
                } else {
                    $message[] = 'File upload failed!';
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
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <h3>Register Now</h3>
        <?php
        if (!empty($message)) {
            foreach ($message as $msg) {
                echo '<div class="message">' . htmlspecialchars($msg) . '</div>';
            }
        }
        ?>
        <input type="text" name="name" placeholder="Enter username" class="box" required>
        <input type="email" name="email" placeholder="Enter email" class="box" required>
        <input type="password" name="password" placeholder="Enter password" class="box" required>
        <input type="password" name="cpassword" placeholder="Confirm password" class="box" required>
        <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png" required>
        <input type="submit" name="submit" value="Register Now" class="btn">
        <p>Already have an account? <a href="login.php">Login now</a></p>
    </form>
</div>

</body>
</html>


