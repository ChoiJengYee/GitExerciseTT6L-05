<?php
if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $event_name = $_POST['event_name'];
    $event_date = $_POST['event_date'];
    $event_description = $_POST['event_description'];
    $event_location = $_POST['event_location'];
    $event_contact = $_POST['event_contact'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "event";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO events (name, date, description, location, contact) VALUES (?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $event_name, $event_date, $event_description, $event_location, $event_contact);

    if ($stmt->execute() === TRUE) {
        header("Location: event.html");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: event.html");
    exit();
}
?>


