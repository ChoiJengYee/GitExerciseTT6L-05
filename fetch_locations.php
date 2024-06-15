<?php
include 'config.php';

$sql = "SELECT id, locationName, lat, lng, description FROM locations";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $locations = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $locations[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($locations);
} else {
    echo json_encode(array());
}

mysqli_close($conn);
?>
