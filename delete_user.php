<?php
include 'config.php';

if (isset($_GET['id'])) {
    $userId = mysqli_real_escape_string($conn, $_GET['id']);

    // Delete user from the database
    $sql = "DELETE FROM users WHERE id = '$userId'";
    if (mysqli_query($conn, $sql)) {
        echo "User deleted successfully.";
    } else {
        echo "Error deleting user: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}

// Close connection
mysqli_close($conn);

// Redirect back to the user list
header('Location: manage_user.php');
exit;
?>
