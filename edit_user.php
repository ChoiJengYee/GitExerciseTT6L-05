<?php
include 'config.php';

if (isset($_GET['id'])) {
    $userId = mysqli_real_escape_string($conn, $_GET['id']);

    // Retrieve user data
    $sql = "SELECT * FROM users WHERE id = '$userId'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
    } else {
        die('User not found.');
    }
} else {
    die('Invalid request.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = !empty($_POST['password']) ? md5(mysqli_real_escape_string($conn, $_POST['password'])) : $user['password'];
    $image = $_FILES['image']['name'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_img/' . $image;

    if (!empty($image)) {
        move_uploaded_file($image_tmp_name, $image_folder);
    } else {
        $image = $user['image'];
    }

    $sql = "UPDATE users SET name = '$name', email = '$email', password = '$password', image = '$image' WHERE id = '$userId'";

    if (mysqli_query($conn, $sql)) {
        echo "User updated successfully.";
        header('Location: manage_user.php');
        exit;
    } else {
        echo "Error updating user: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>
    <h2>Edit User</h2>
    <form action="edit_user.php?id=<?= $userId ?>" method="post" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required><br>
        <label for="email">Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required><br>
        <label for="password">Password (leave blank to keep current):</label>
        <input type="password" name="password"><br>
        <label for="image">Profile Image:</label>
        <input type="file" name="image" accept="image/*"><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>

<?php
// Close connection
mysqli_close($conn);
?>
