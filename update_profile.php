<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

$select = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$user_id'") or die('Query failed');
$fetch = mysqli_fetch_assoc($select);

if (!$fetch) {
    header('location: error.php');
    exit;
}

$message = [];

if (isset($_POST['update_profile'])) {
    $update_name = mysqli_real_escape_string($conn, $_POST['update_name']);
    $update_email = mysqli_real_escape_string($conn, $_POST['update_email']);

    mysqli_query($conn, "UPDATE `users` SET name = '$update_name', email = '$update_email' WHERE id = '$user_id'") or die('Query failed');

    $old_pass = $_POST['old_name'];
    $update_pass = mysqli_real_escape_string($conn, md5($_POST['update_pass']));
    $new_pass = mysqli_real_escape_string($conn, md5($_POST['new_pass']));
    $confirm_pass = mysqli_real_escape_string($conn, md5($_POST['confirm_pass']));

    if (!empty($update_pass) || !empty($new_pass) || !empty($confirm_pass)) {
        if ($update_pass != $old_pass) {
            $message[] = 'Old password does not match!';
        } elseif ($new_pass != $confirm_pass) {
            $message[] = 'New passwords do not match!';
        } else {
            mysqli_query($conn, "UPDATE `users` SET password = '$confirm_pass' WHERE id = '$user_id'") or die('Query failed');
            $message[] = 'Password updated successfully!';
        }
    }

    if (!empty($_FILES['update_image']['name'])) {
        $update_image_name = $_FILES['update_image']['name'];
        $update_image_size = $_FILES['update_image']['size'];
        $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
        $update_image_folder = 'uploaded_img/' . $update_image_name;

        if (!is_dir('uploaded_img')) {
            mkdir('uploaded_img', 0777, true);
        }

        if ($update_image_size > 0) {
            if ($update_image_size > 2000000) {
                $message[] = 'Image size is too large (max 2MB).';
            } else {
                if (move_uploaded_file($update_image_tmp_name, $update_image_folder)) {
                    mysqli_query($conn, "UPDATE `users` SET image = '$update_image_name' WHERE id = '$user_id'") or die('Query failed');
                    $message[] = 'Image updated successfully!';
                } else {
                    $message[] = 'Failed to upload image!';
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
    <title>Update Profile</title>
    <link rel="stylesheet" href="register.css">
<style>
/* Define root variables */
:root {
    --light-bg: #f4f4f4;
    --white: #fff;
    --black: #333;
    --box-shadow: 0 0 15px rgba(0,0,0,0.1);
}

/* Body styles */
body {
    font-family: Arial, sans-serif;
    background-color: var(--light-bg);
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

/* Form container */
.update-profile {
    min-height: 100vh;
    background-color: var(--light-bg); 
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

/* Form styles */
.update-profile form {
    padding: 20px;
    background-color: var(--white);
    box-shadow: var(--box-shadow); 
    text-align: center;
    width: 700px;
    border-radius: 5px;
}

/* Profile image container */
.profile-img-container {
    text-align: center;
    margin-bottom: 20px;
}

/* Profile image */
.profile-img-container img {
    height: 200px;
    width: 200px;
    border-radius: 50%; 
    object-fit: cover;
    margin-bottom: 5px;
}

/* Form flex layout */
.update-profile form .flex {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    margin-bottom: 20px;
    gap: 15px;
}

/* Input box */
.update-profile form .flex .inputBox {
    width: 49%;
}

/* Input box label */
.update-profile form .flex .inputBox span {
    text-align: left;
    display: block;
    margin-top: 15px;
    font-size: 17px;
    color: var(--black);
}

/* Input field */
.update-profile form .flex .inputBox .box {
    width: 100%;
    border-radius: 5px;
    background-color: var(--light-bg);
    padding: 12px 14px;
    font-size: 17px;
    color: var(--black);
    margin-top: 10px;
    transition: background-color 0.3s ease;
}

/* Error message */
.message {
    color: white;
    margin-bottom: 10px;
}

/* Primary button */
.btn {
    padding: 12px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    font-size: 17px;
    margin-top: 20px;
    background-color: #28a745;
    color: #fff;
}

/* Primary button hover */
.btn:hover {
    background-color: #218838;
}

/* Delete button */
.delete-btn {
    background-color: #dc3545;
    color: #fff;
    text-decoration: none;
    display: inline-block;
}

/* Delete button hover */
.delete-btn:hover {
    background-color: #c82333;
}

/* Responsive design */
@media (max-width: 650px) {
    .update-profile form .flex {
        flex-wrap: wrap;
        gap: 0;
    }
    .update-profile form .flex .inputBox {
        width: 100%; 
    }
}
</style>
</head>
<body>

<div class="update-profile">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="profile-img-container">
            <?php
            if (!empty($fetch)) {
                if ($fetch['image'] == '') {
                    echo '<img src="images/default-avatar.png">';
                } else {
                    echo '<img src="uploaded_img/' . $fetch['image'] . '">';
                }
            }
            ?>
        </div>
        <?php
        if (isset($message)) {
            foreach ($message as $msg) {
                echo '<div class="message">' . $msg . '</div>';
            }
        }
        ?>
        <div class="flex">
            <div class="inputBox">
                <span>Username:</span>
                <input type="text" name="update_name" value="<?php echo $fetch['name'] ?>" class="box" required>
                <span>Email:</span>
                <input type="email" name="update_email" value="<?php echo $fetch['email'] ?>" class="box" required>
                <span>Update Profile Picture:</span>
                <input type="file" name="update_image" accept="image/jpg, image/jpeg, image/png" class="box">
            </div>
            <div class="inputBox">
                <input type="hidden" name="old_name" value="<?php echo $fetch['password'] ?>">
                <span>Old Password:</span>
                <input type="password" name="update_pass" placeholder="Enter previous password" class="box">
                <span>New Password:</span>
                <input type="password" name="new_pass" placeholder="Enter new password" class="box">
                <span>Confirm Password:</span>
                <input type="password" name="confirm_pass" placeholder="Confirm new password" class="box">
            </div>
        </div>
        <input type="submit" value="Update Profile" name="update_profile" class="btn">
        <a href="about us.php" class="delete-btn">Go Back</a>
    </form>
</div>

</body>
</html>
