<?php
if(isset($_GET['id']) && !empty($_GET['id'])) {
    include 'config.php';

    $id = $_GET['id'];

    $sql = "UPDATE messages SET status = 'Replied' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute() === TRUE) {
        header("Location: manage_messages.php?message=Message%20replied%20successfully!");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request!";
}
?>

