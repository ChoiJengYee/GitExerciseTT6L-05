<?php
include 'config2.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM events WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Event deleted successfully";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();

    header("Location: event.php");
    exit;
}
?>


