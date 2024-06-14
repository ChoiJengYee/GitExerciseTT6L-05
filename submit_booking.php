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

    foreach ($options as $locationName) {
        // Prepare SQL to fetch locationID based on location_name
        $sql_select_location = "SELECT id FROM locations WHERE locationName = '$locationName'";
        $result = $conn->query($sql_select_location);

        if ($result && $result->num_rows > 0) {
            // Fetch locationID
            $row = $result->fetch_assoc();
            $locationID = $row['id'];

            // Insert into bookings table
            $sql_insert_booking = "INSERT INTO bookings (fullname, email, visit_date, locationID) 
                                   VALUES ('$fullname', '$email', '$visit_date', $locationID)";

            if ($conn->query($sql_insert_booking) === TRUE) {
                echo "New record created successfully for location: $locationName<br>";
            } else {
                echo "Error: " . $sql_insert_booking . "<br>" . $conn->error;
            }
        } else {
            echo "Error: Location not found in the database: $locationName<br>";
        }
    }
}

$conn->close();
?>
