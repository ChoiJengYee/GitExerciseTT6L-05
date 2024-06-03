<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "campus_information";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_GET['id'])) {
=    $id = intval($_GET['id']);

=    $sql = "DELETE FROM locations WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

=    if ($stmt->execute()) {
=        echo json_encode(array("message" => "Location deleted successfully."));
    } else {
=        echo json_encode(array("message" => "Error deleting location."));
    }

    $stmt->close();
} else {
    echo json_encode(array("message" => "ID parameter is missing."));
}

$conn->close();
?>
