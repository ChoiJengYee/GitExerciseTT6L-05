<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "campus_information";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $location = $_POST['location'];

    $sql = "UPDATE locations SET name=?, description=?, location=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $name, $description, $location, $id);

    if ($stmt->execute()) {
    
        echo "Location updated successfully.";
    } else {
        echo "Error updating location: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>



