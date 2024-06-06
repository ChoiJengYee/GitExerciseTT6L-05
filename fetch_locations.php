<?php
// Connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'user_db') or die('connection failed');

// Fetch locations from the database
$sql = "SELECT id, locationName, lat, lng, description FROM locations";
$result = mysqli_query($conn, $sql);

// Check if any rows are returned
if (mysqli_num_rows($result) > 0) {
    // Initialize an array to store the locations
    $locations = array();

    // Fetch associative array of locations
    while ($row = mysqli_fetch_assoc($result)) {
        // Add each location to the array
        $locations[] = $row;
    }

    // Output the locations array as JSON
    header('Content-Type: application/json');
    echo json_encode($locations);
} else {
    // No locations found
    echo json_encode(array());
}

// Close database connection
mysqli_close($conn);
?>
