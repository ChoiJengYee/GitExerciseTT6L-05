<?php
include 'config2.php';

if(isset($_GET['id'])) {
    $event_id = $_GET['id'];

    $sql = "SELECT * FROM events WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $event_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if(mysqli_num_rows($result) > 0) {
        $event = mysqli_fetch_assoc($result);
    } else {
        echo "Event not found.";
        exit();
    }
} else {
    echo "Event ID not provided.";
    exit();
}

if(isset($_POST['update_event'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $event_date = $_POST['event_date'];

    $sql = "UPDATE events SET title = ?, description = ?, event_date = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssi", $title, $description, $event_date, $event_id);
    
    if(mysqli_stmt_execute($stmt)) {
        header("Location: event.php");
        exit();
    } else {
        echo "Error updating event: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
    <!-- Include any CSS stylesheets here -->
</head>
<body>
    <h1>Edit Event</h1>
    <form action="" method="post">
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" value="<?php echo $event['title']; ?>"><br>
        
        <label for="description">Description:</label><br>
        <textarea id="description" name="description"><?php echo $event['description']; ?></textarea><br>
        
        <label for="event_date">Event Date:</label><br>
        <input type="date" id="event_date" name="event_date" value="<?php echo $event['event_date']; ?>"><br>
        
        <input type="submit" name="update_event" value="Update Event">
    </form>
</body>
</html>
