<?php
if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $faculty_name = $_POST['faculty_name'];
    $faculty_description = $_POST['faculty_description'];
    $faculty_location = $_POST['faculty_location'];
    $faculty_contact = $_POST['faculty_contact'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "campus_information";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO faculties (name, description, location, contact) VALUES (?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $faculty_name, $faculty_description, $faculty_location, $faculty_contact);

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

