<?php
include 'auth.php';
include 'config.php';

if (isset($_POST['create_admin'])) {
    $username = isset($_POST['username']) ? mysqli_real_escape_string($conn, $_POST['username']) : '';
    $password = isset($_POST['password']) ? mysqli_real_escape_string($conn, $_POST['password']) : '';
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    if (!empty($username) && !empty($password)) {
        $sql = "INSERT INTO admins (username, password) VALUES (?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $username, $hashed_password);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        
        echo "New admin created successfully.";
    } else {
        echo "Please fill in all fields.";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Admin</title>
    <link rel="stylesheet" href="create_admin.css">
</head>
<body>

<div class="form-container">
    <form action="create_admin.php" method="post">
        <h3>Create Admin</h3>
        <?php
        if (!empty($message)) {
            foreach ($message as $msg) {
                echo '<div class="message">' . $msg . '</div>';
            }
        }
        ?>
        <input type="text" name="username" placeholder="Enter admin username" class="box" required>
        <input type="password" name="password" placeholder="Enter admin password" class="box" required>
        <input type="submit" name="create_admin" value="Create Admin" class="btn">
    </form>
</div>

</body>
</html>
