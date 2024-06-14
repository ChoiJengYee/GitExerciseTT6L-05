<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $visit_date = $_POST['visit_date'];
    $options = isset($_POST['option']) ? $_POST['option'] : [];

    foreach ($options as $locationName) {
        $sql_select_location = "SELECT id FROM locations WHERE locationName = '$locationName'";
        $result = $conn->query($sql_select_location);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $locationID = $row['id'];

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
