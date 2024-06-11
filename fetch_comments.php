<?php
// Connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'user_db') or die('Connection failed: ' . mysqli_connect_error());

// Retrieve locationID from GET request
$locationID = $_GET['locationID'] ?? null;

if ($locationID === null) {
    echo json_encode(['error' => 'locationID parameter is missing']);
    exit;
}

// Prepare SQL statement to fetch comments
$sql = "SELECT comment, created_at FROM comments WHERE locationID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $locationID); // Assuming locationID is an integer
$stmt->execute();
$result = $stmt->get_result();

$comments = [];

while ($row = $result->fetch_assoc()) {
    $comments[] = $row;
}

// Close statement and connection
$stmt->close();
$conn->close();

// Return comments as JSON
header('Content-Type: application/json');
echo json_encode($comments);
?>
