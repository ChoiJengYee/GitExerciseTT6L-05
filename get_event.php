<?php
include 'config.php';  

header('Content-Type: application/json');

$sql = "SELECT event_date, description, registration_url, start_time, end_time, location, images FROM events";
$result = $conn->query($sql);

$events = array();
while ($row = $result->fetch_assoc()) {
    $event_date = date('n-j', strtotime($row['event_date'])); 
    $events[$event_date] = array(
        'description' => $row['description'],
        'url' => $row['registration_url'],
        'start_time' => $row['start_time'],
        'end_time' => $row['end_time'],
        'location' => $row['location'],
        'images' => $row['images']
    );
}

echo json_encode($events);

$conn->close();
?>




