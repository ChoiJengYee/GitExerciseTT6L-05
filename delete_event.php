<?php
header("Content-Type: application/json");

// Check if the request method is DELETE
if ($_SERVER["REQUEST_METHOD"] !== "DELETE") {
    http_response_code(405); // Method Not Allowed
    echo json_encode(["error" => "Invalid request method"]);
    exit();
}

// Retrieve the event ID from the request body
$data = json_decode(file_get_contents("php://input"), true);
$eventId = $data['id'] ?? '';

// Validate event ID
if (empty($eventId)) {
    http_response_code(400); // Bad Request
    echo json_encode(["error" => "Event ID is required"]);
    exit();
}

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "event";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare a delete statement
$sql = "DELETE FROM events WHERE id = ?";
$stmt = $conn->prepare($sql);

// Bind parameters
$stmt->bind_param("i", $eventId);

// Execute the statement
if ($stmt->execute()) {
    // Event deleted successfully
    http_response_code(200); // OK
    echo json_encode(["success" => true]);
} else {
    // Error occurred while deleting the event
    http_response_code(500); // Internal Server Error
    echo json_encode(["error" => "Error deleting event"]);
}

// Close statement and database connection
$stmt->close();
$conn->close();
?>
