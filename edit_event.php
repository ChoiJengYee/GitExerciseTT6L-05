<?php
include 'config2.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $event_date = $_POST['event_date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $location = $_POST['location'];
    $description = $_POST['description'];
    $registration_url = $_POST['registration_url'];

    $image_uploaded = !empty($_FILES['images']['name']);
    if ($image_uploaded) {
        $image = $_FILES['images']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($image);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $extensions_arr = array("jpg", "jpeg", "png", "gif");

        if (in_array($imageFileType, $extensions_arr)) {
            move_uploaded_file($_FILES['images']['tmp_name'], $target_file);
        } else {
            echo "Invalid file type.";
            exit;
        }
    }

    $sql = "UPDATE events SET event_date='$event_date', start_time='$start_time', end_time='$end_time', location='$location', description='$description', registration_url='$registration_url'";
    if ($image_uploaded) {
        $sql .= ", images='$target_file'";
    }
    $sql .= " WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: event.php");
        exit();
    } else {
        echo "Error updating event: " . $conn->error;
    }

    $conn->close();
} else {
    $id = $_GET['id'];
    $sql = "SELECT * FROM events WHERE id=$id";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    } else {
        echo "Event not found.";
        $conn->close();
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Event</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1 class="mt-5">Edit Event</h1>
    <form method="POST" action="edit_event.php" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <div class="form-group">
            <label for="event_date">Event Date</label>
            <input type="date" class="form-control" id="event_date" name="event_date" value="<?php echo $row['event_date']; ?>" required>
        </div>
        <div class="form-group">
            <label for="start_time">Start Time</label>
            <input type="time" class="form-control" id="start_time" name="start_time" value="<?php echo $row['start_time']; ?>" required>
        </div>
        <div class="form-group">
            <label for="end_time">End Time</label>
            <input type="time" class="form-control" id="end_time" name="end_time" value="<?php echo $row['end_time']; ?>" required>
        </div>
        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" class="form-control" id="location" name="location" value="<?php echo $row['location']; ?>" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required><?php echo $row['description']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="registration_url">Registration URL</label>
            <input type="url" class="form-control" id="registration_url" name="registration_url" value="<?php echo $row['registration_url']; ?>">
        </div>
        <div class="form-group">
            <label for="images">Image</label>
            <input type="file" class="form-control" id="images" name="images" accept="image/*">
            <img src="<?php echo $row['images']; ?>" alt="Event Image" style="max-width: 100px;">
        </div>
        <button type="submit" class="btn btn-primary">Update Event</button>
    </form>
</div>
</body>
</html>

<?php
$conn->close();
?>

