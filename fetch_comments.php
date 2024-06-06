<?php
$conn = mysqli_connect('localhost', 'root', '', 'user_db') or die('Connection failed: ' . mysqli_connect_error());

if (isset($_GET['locationID'])) {
    $locationID = $_GET['locationID'];

    // Fetch comments for the specified locationID
    $sql = "SELECT comment, created_at FROM comments WHERE locationID = ? ORDER BY created_at DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $locationID);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if any comments are returned
    if ($result->num_rows > 0) {
        // Initialize an array to store comments
        $comments = array();

        // Fetch associative array of comments
        while ($row = $result->fetch_assoc()) {
            // Add each comment to the array
            $comments[] = $row;
        }

        // Output the comments array as JSON
        header('Content-Type: application/json');
        echo json_encode($comments);
    } else {
        // No comments found for the specified locationID
        echo json_encode(array());
    }
} else {
    // locationID not provided in the query string
    echo "Error: locationID parameter is missing.";
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
