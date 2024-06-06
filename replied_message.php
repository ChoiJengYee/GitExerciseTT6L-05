<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM messages WHERE id = ?";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: manage_message.php");
        exit();
    } else {
        echo "Error reply record: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: manage_message.php");
    exit();
}
?>

