<?php
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location: login.php');
    exit;
}

$select = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$user_id'");
$fetch = mysqli_fetch_assoc($select);

if (!$fetch) {
    header('location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }

        .profile {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .profile img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #ddd;
        }

        .btn, .delete-btn, .auth-btn {
            display: inline-block;
            padding: 10px 20px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
            margin-top: 10px;
        }

        .btn:hover, .auth-btn:hover {
            background: #0056b3;
        }

        .delete-btn {
            background: #dc3545;
        }

        .delete-btn:hover {
            background: #c82333;
        }

        .auth-btn {
            background: #6c757d;
        }

        .auth-btn:hover {
            background: #5a6268;
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

<div class="container">
    <div class="profile">
        <?php
            if (!empty($fetch)) {
                if ($fetch['image'] == '') {
                    echo '<img src="images/default-avatar.png">';
                } else {
                    echo '<img src="uploaded_img/' . $fetch['image'] . '">';
                }
            }
            ?>
        <h3>Hello, <?php echo htmlspecialchars($fetch['name']); ?></h3>
        <a href="update_profile.php" class="btn">Update Profile</a>
        <a href="logout.php" class="delete-btn">Logout</a>
        <a href="about us.php" class="btn">Next</a>
        <p>New <a href="login.php" class="auth-btn">Login</a> or <a href="register.php" class="auth-btn">Register</a></p>
    </div>
</div>

</body>
</html>

