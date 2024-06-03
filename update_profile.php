<?php
include 'config.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Retrieve user data from the database based on the user ID
$select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id'") or die('Query failed');
$fetch = mysqli_fetch_assoc($select);

// Check if user data is retrieved successfully
if (!$fetch) {
    // Redirect or handle the scenario where user data is not found
    // For example, redirect to an error page
    header('location: error.php');
    exit;
}

// Initialize message array
$message = [];

// Process form submission when update profile button is clicked
if (isset($_POST['update_profile'])) {
    $update_name = mysqli_real_escape_string($conn, $_POST['update_name']);
    $update_email = mysqli_real_escape_string($conn, $_POST['update_email']);

    // Update user name and email in the database
    mysqli_query($conn, "UPDATE `user_form` SET name = '$update_name', email = '$update_email' WHERE id = '$user_id'") or die('Query failed');

    // Handle password update if requested
    $old_pass = $_POST['old_name']; // Assuming this is the current password
    $update_pass = mysqli_real_escape_string($conn, md5($_POST['update_pass']));
    $new_pass = mysqli_real_escape_string($conn, md5($_POST['new_pass']));
    $confirm_pass = mysqli_real_escape_string($conn, md5($_POST['confirm_pass']));

    if (!empty($update_pass) || !empty($new_pass) || !empty($confirm_pass)) {
        if ($update_pass != $old_pass) {
            $message[] = 'Old password does not match!';
        } elseif ($new_pass != $confirm_pass) {
            $message[] = 'New passwords do not match!';
        } else {
            // Update password in the database
            mysqli_query($conn, "UPDATE `user_form` SET password = '$confirm_pass' WHERE id = '$user_id'") or die('Query failed');
            $message[] = 'Password updated successfully!';
        }
    }

    // Handle profile picture update if an image is uploaded
    if (!empty($_FILES['update_image']['name'])) {
        $update_image_name = $_FILES['update_image']['name'];
        $update_image_size = $_FILES['update_image']['size'];
        $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
        $update_image_folder = 'uploaded_img/' . $update_image_name;

        if ($update_image_size > 0) {
            if ($update_image_size > 2000000) {
                $message[] = 'Image size is too large (max 2MB).';
            } else {
                // Move uploaded image to the desired folder
                if (move_uploaded_file($update_image_tmp_name, $update_image_folder)) {
                    // Update image path in the database
                    mysqli_query($conn, "UPDATE `user_form` SET image = '$update_image_name' WHERE id = '$user_id'") or die('Query failed');
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
</head>
<body>

<div class="update-profile">
    <?php
    if (!empty($fetch)) {
        if ($fetch['image'] == '') {
            echo '<img src="images/default-avatar.png">';
        } else {
            echo '<img src="uploaded_img/' . $fetch['image'] . '">';
        }
    }
    ?>

    <form action="" method="post" enctype="multipart/form-data">
        <?php
        if (!empty($fetch)) {
            if ($fetch['image'] == '') {
                echo '<img src="images/default-avatar.png">';
            } else {
                echo '<img src="uploaded_img/' . $fetch['image'] . '">';
            }
        }

        if (isset($message)) {
            foreach ($message as $msg) {
                echo '<div class="message">' . $msg . '</div>';
            }
        }
        ?>

        <div class="flex">
            <div class="inputBox">
                <span>Username:</span>
                <input type="text" name="update_name" value="<?php echo $fetch['name'] ?>" class="box">
                <span>Email:</span>
                <input type="email" name="update_email" value="<?php echo $fetch['email'] ?>" class="box">
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
        <a href="about.html" class="delete-btn">Go Back</a>
    </form>
</div>

</body>
</html>

<style>
    /* Overall styling for the update profile section */
.update-profile {
    min-height: 100vh;
    background-color: var(--light-bg); /* Background color */
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

/* Styling for the form container within update profile section */
.update-profile form {
    padding: 20px;
    background-color: var(--white); /* Background color */
    box-shadow: var(--box-shadow); /* Box shadow for the form */
    text-align: center;
    width: 700px;
    border-radius: 5px;
}

/* Styling for the profile image within the form */
.update-profile form img {
    height: 200px;
    width: 200px;
    border-radius: 50%; /* Rounded corners for circular image */
    object-fit: cover; /* Maintain aspect ratio of the image */
    margin-bottom: 5px;
}

/* Styling for the flex container within the form for layout */
.update-profile form .flex {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    margin-bottom: 20px;
    gap: 15px;
}

/* Styling for input boxes and their labels within the flex container */
.update-profile form .flex .inputBox {
    width: 49%;
}

.update-profile form .flex .inputBox span {
    text-align: left;
    display: block;
    margin-top: 15px;
    font-size: 17px;
    color: var(--black);
}

.update-profile form .flex .inputBox .box {
    width: 100%;
    border-radius: 5px;
    background-color: var(--light-bg);
    padding: 12px 14px;
    font-size: 17px;
    color: var(--black);
    margin-top: 10px;
}

/* Responsive design for smaller screens */
@media (max-width: 650px) {
    .update-profile form .flex {
        flex-wrap: wrap;
        gap: 0;
    }
    .update-profile form .flex .inputBox {
        width: 100%; /* Full width for input box on smaller screens */
    }
}

</style>