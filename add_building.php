<?php
if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $building_name = $_POST['building_name'];
    $building_description = $_POST['building_description'];
    $building_location = $_POST['building_location'];
    $building_contact = $_POST['building_contact'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "campus_information";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind
    $sql = "INSERT INTO buildings (name, description, location, contact) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $building_name, $building_description, $building_location, $building_contact);

    // Execute and check result
    if ($stmt->execute() === TRUE) {
        // Output before redirecting is not recommended, better to handle this in HTML
        header("Location: entry.html");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close connections
    $stmt->close();
    $conn->close();
} else {
    header("Location: entry.html");
    exit();
}
?>















