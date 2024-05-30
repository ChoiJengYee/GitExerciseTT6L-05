<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "campus_information";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$building_sql = "SELECT * FROM buildings";
$building_result = $conn->query($building_sql);
$buildings = [];

if ($building_result->num_rows > 0) {
    while ($row = $building_result->fetch_assoc()) {
        $buildings[] = $row;
    }
}

$faculty_sql = "SELECT * FROM faculties";
$faculty_result = $conn->query($faculty_sql);
$faculties = [];

if ($faculty_result->num_rows > 0) {
    while ($row = $faculty_result->fetch_assoc()) {
        $faculties[] = $row;
    }
}

echo json_encode(['buildings' => $buildings, 'faculties' => $faculties,]);

$conn->close();
?>


