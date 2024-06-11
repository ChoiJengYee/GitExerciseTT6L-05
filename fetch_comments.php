<<<<<<< HEAD
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
=======
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
>>>>>>> 39efedb40f30d12dd09713fe312db61ed2fa3a3a
