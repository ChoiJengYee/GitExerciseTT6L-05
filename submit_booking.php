<?php
include 'config.php';

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
                // Successfully inserted, do nothing more
            } else {
                echo "Error: " . $sql_insert_booking . "<br>" . $conn->error;
            }
        } else {
            echo "Error: Location not found in the database: $locationName<br>";
        }
    }

    // Fetch bookings for the current user
    $sql_fetch_bookings = "SELECT b.fullname, b.email, b.visit_date, l.locationName 
                           FROM bookings b 
                           INNER JOIN locations l ON b.locationID = l.id
                           WHERE b.email = '$email'";
    $result = $conn->query($sql_fetch_bookings);

    if ($result && $result->num_rows > 0) {
        echo '<table>';
        echo '<tr><th>Fullname</th><th>Email</th><th>Visit Date</th><th>Location</th></tr>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row['fullname']) . '</td>';
            echo '<td>' . htmlspecialchars($row['email']) . '</td>';
            echo '<td>' . htmlspecialchars($row['visit_date']) . '</td>';
            echo '<td>' . htmlspecialchars($row['locationName']) . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo "No bookings found.";
    }

} else {
    echo "Invalid request.";
}

$conn->close();
?>





