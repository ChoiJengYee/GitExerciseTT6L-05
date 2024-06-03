<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "event";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$event_sql = "SELECT * FROM events"; // Query to select all records from the events table
$event_result = $conn->query($event_sql);
$events = [];

if ($event_result->num_rows > 0) {
    while ($row = $event_result->fetch_assoc()) {
        $events[] = $row;
    }
}

echo json_encode(['events' => $events]); // Encode the events array as JSON and echo it

$conn->close();
?>
