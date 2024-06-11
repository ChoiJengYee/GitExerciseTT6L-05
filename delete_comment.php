<?php
// Include database connection
include_once 'config.php';

// Check if comment ID is set and is numeric
if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $comment_id = $_GET['id'];

    // SQL query to delete comment
    $sql_delete_comment = "DELETE FROM comments WHERE id = $comment_id";

    // Execute the delete query
    if ($conn->query($sql_delete_comment) === TRUE) {
        // Redirect back to the manage comments page after deletion
        header("Location: comments.php");
        exit();
    } else {
        // If an error occurs during deletion, display an error message
        echo "Error deleting comment: " . $conn->error;
    }
} else {
    // If comment ID is not set or not numeric, display an error message
    echo "Invalid comment ID";
}

// Close database connection
$conn->close();
?>
