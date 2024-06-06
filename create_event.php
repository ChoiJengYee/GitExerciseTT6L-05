<?php
include 'config2.php';

if(isset($_POST['title']) && isset($_POST['description']) && isset($_POST['event_date'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $event_date = $_POST['event_date'];

    $stmt = $conn->prepare("INSERT INTO events (title, description, event_date) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $title, $description, $event_date);

    if ($stmt->execute()) {
        echo "Event created successfully";
    } else {
        echo "Error creating event: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "Error: All fields are required";
}

$conn->close();
?>
