<?php
if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $event_Id = $_POST['event_id'];
    $event_Name = $_POST['event_name'];
    $event_Date = $_POST['event_date'];
    $event_Description = $_POST['event_description'];
    $event_Location = $_POST['event_location'] ;
    $event_Contact = $_POST['event_contact'];

    $entry_type = 'event';

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "event";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $table = ($entry_type == 'event') ? 'events' : '';

    if(empty($table)) {
        die("Invalid entry type");
    }

    $sql = "UPDATE $table SET name=?, date=?, description=?, location=?, contact=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $event_Name, $event_Date, $event_Description, $event_Location, $event_Contact, $event_Id);

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

