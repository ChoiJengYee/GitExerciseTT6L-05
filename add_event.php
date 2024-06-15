<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $event_date = $_POST['event_date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $location = $_POST['location'];
    $description = $_POST['description'];
    $registration_url = $_POST['registration_url'];
    $images = $_POST['images'];

    $sql = "INSERT INTO events (event_date, start_time, end_time, location, description, registration_url, images)
            VALUES ('$event_date', '$start_time', '$end_time', '$location', '$description', '$registration_url', '$images')";

    if ($conn->query($sql) === TRUE) {
        echo "New event created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();

    header("Location: event.php");
    exit;
}
?>

