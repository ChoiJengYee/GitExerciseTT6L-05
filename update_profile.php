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

$message = '';

if (isset($_POST['update_profile'])) {
    $update_name = mysqli_real_escape_string($conn, $_POST['update_name']);
    $update_email = mysqli_real_escape_string($conn, $_POST['update_email']);
    
    // Check if passwords are being updated
    $update_pass = $_POST['update_pass'];
    $new_pass = $_POST['new_pass'];
    $confirm_pass = $_POST['confirm_pass'];

    // Flag to track if any update was successfully performed
    $updated = false;

    // Update name and email
    if (!empty($update_name) || !empty($update_email)) {
        mysqli_query($conn, "UPDATE `users` SET name = '$update_name', email = '$update_email' WHERE id = '$user_id'") or die('Query failed');
        $message = 'Profile details updated successfully!';
        $updated = true;
        // Update the $fetch array with the new name and email
        $fetch['name'] = $update_name;
        $fetch['email'] = $update_email;
    }

    // Handle profile image update
    if (!empty($_FILES['update_image']['name'])) {
        $update_image_name = $_FILES['update_image']['name'];
        $update_image_size = $_FILES['update_image']['size'];
        $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
        $update_image_folder = 'uploaded_img/' . $update_image_name;

        if ($update_image_size > 0) {
            if ($update_image_size > 2000000) {
                $message = 'Image size is too large (max 2MB).';
            } else {
                if (move_uploaded_file($update_image_tmp_name, $update_image_folder)) {
                    mysqli_query($conn, "UPDATE `users` SET image = '$update_image_name' WHERE id = '$user_id'") or die('Query failed');
                    $message = 'Profile picture updated successfully!';
                    $updated = true;
                    // Update the $fetch array with the new image name
                    $fetch['image'] = $update_image_name;
                } else {
                    $message = 'Failed to upload image!';
                }
            }
        }
    }

    // Update password
    if (!empty($update_pass) || !empty($new_pass) || !empty($confirm_pass)) {
        $old_pass = mysqli_real_escape_string($conn, md5($update_pass));
        $update_pass = mysqli_real_escape_string($conn, md5($new_pass));
        $confirm_pass = mysqli_real_escape_string($conn, md5($confirm_pass));

        if ($update_pass != $confirm_pass) {
            $message = 'New passwords do not match!';
        } elseif ($old_pass != $fetch['password']) {
            $message = 'Old password does not match!';
        } else {
            // Update password if new password is provided and matches confirmation
            mysqli_query($conn, "UPDATE `users` SET password = '$update_pass' WHERE id = '$user_id'") or die('Query failed');
            $message = 'Password updated successfully!';
            $updated = true;
        }
    }

    // If no update was performed, display a message
    if (!$updated) {
        $message = 'No changes made.';
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
    <style>
    /* Reset some basic elements to provide a consistent baseline */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Arial', sans-serif;
        background-color: #f0f2f5;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        color: #333;
    }

    .update-profile {
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 600px;
    }

    .update-profile form {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .profile-img-container {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
    }

    .profile-img-container img {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
    }

    .flex {
        display: flex;
        gap: 20px;
    }

    .inputBox {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .inputBox span {
        font-weight: bold;
    }

    .inputBox .box {
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        width: 100%;
    }

    .inputBox .box[type="file"] {
        border: none;
    }

    .btn {
        padding: 10px 20px;
        background: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .btn:hover {
        background: #0056b3;
    }

    .delete-btn {
        display: inline-block;
        padding: 10px 20px;
        background: #dc3545;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        text-align: center;
        margin-top: 10px;
        transition: background 0.3s ease;
    }

    .delete-btn:hover {
        background: #c82333;
    }

    .message {
        background: #ffdddd;
        color: #d8000c;
        padding: 10px;
        border-left: 6px solid #d8000c;
        margin-bottom: 10px;
        border-radius: 5px;
    }

    /* Styling for error messages */
    .error-message {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
    </style>
</head>
<body>

<div class="update-profile">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="profile-img-container">
            <?php if (!empty($fetch['image'])): ?>
                <img src="uploaded_img/<?php echo $fetch['image']; ?>" alt="Profile Picture">
            <?php else: ?>
                <img src="images/default-avatar.png" alt="Default Avatar">
            <?php endif; ?>
        </div>
        <?php if (!empty($message)): ?>
            <div class="message <?php echo (strpos($message, 'successfully') !== false) ? '' : 'error-message'; ?>"><?php echo $message; ?></div>
        <?php endif; ?>
        <div class="flex">
            <div class="inputBox">
                <span>Username:</span>
                <input type="text" name="update_name" value="<?php echo $fetch['name']; ?>" class="box">
                <span>Email:</span>
                <input type="email" name="update_email" value="<?php echo $fetch['email']; ?>" class="box">
                <span>Update Profile Picture:</span>
                <input type="file" name="update_image" accept="image/jpg, image/jpeg, image/png" class="box">
            </div>
            <div class="inputBox">
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


    









