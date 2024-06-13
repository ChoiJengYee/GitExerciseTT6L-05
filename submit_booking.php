<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $visit_date = $_POST['visit_date'];
    $options = isset($_POST['option']) ? $_POST['option'] : [];

    foreach ($options as $locationID) {
        $sql = "INSERT INTO bookings (fullname, email, visit_date, locationID, status) VALUES ('$fullname', '$email', '$visit_date', $locationID, 'Pending')";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully for location ID: $locationID<br>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>

