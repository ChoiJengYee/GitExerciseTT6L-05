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
