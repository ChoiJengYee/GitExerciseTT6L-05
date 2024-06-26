<?php
// Connect to the database
include 'config.php';

// Get the data from the POST request
$locationID = $_POST['locationID'];
$comment = $_POST['comment'];

// Insert the comment into the comments table along with the locationID
$sql = "INSERT INTO comments (locationID, comment) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $locationID, $comment);

if ($stmt->execute()) {
    echo "Comment submitted successfully!";
} else {
    echo "Error: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
