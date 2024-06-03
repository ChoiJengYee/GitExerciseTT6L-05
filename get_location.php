<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "campus_information";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM locations";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $locations = array();

    while ($row = $result->fetch_assoc()) {
        $locations[] = $row;
    }

    echo json_encode($locations);
} else {
    echo json_encode(array('message' => 'No locations found.'));
}

$conn->close();
?>