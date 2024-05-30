<?php
if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $entry_id = $_POST['entry_id'];
    $entry_type = $_POST['entry_type'];
    $entry_name = $_POST['entry_name'];
    $entry_description = $_POST['entry_description'];
    $entry_location = $_POST['entry_location'];
    $entry_contact = $_POST['entry_contact'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "campus_information";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $table = ($entry_type == 'building') ? 'buildings' : 'faculties';

    $sql = "UPDATE $table SET name=?, description=?, location=?, contact=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $entry_name, $entry_description, $entry_location, $entry_contact, $entry_id);

    if ($stmt->execute() === TRUE) {
        header("Location: entry.html");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: entry.html");
    exit();
}
?>




