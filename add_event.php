<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Initialize variables for form data
    $event_date = $_POST['event_date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $location = $_POST['location'];
    $description = $_POST['description'];
    $registration_url = $_POST['registration_url'];

    // Check if an image was uploaded
    $image_uploaded = !empty($_FILES['images']['name']);
    if ($image_uploaded) {
        $image = $_FILES['images']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($image);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $extensions_arr = array("jpg", "jpeg", "png", "gif");

        // Check if the file type is allowed
        if (in_array($imageFileType, $extensions_arr)) {
            // Attempt to move uploaded file to target directory
            if (move_uploaded_file($_FILES['images']['tmp_name'], $target_file)) {
                echo "The file ". htmlspecialchars(basename($image)). " has been uploaded successfully.";
            } else {
                echo "Sorry, there was an error uploading your file.";
                exit;
            }
        } else {
            echo "Invalid file type. Allowed types: jpg, jpeg, png, gif.";
            exit;
        }
    }

    // Insert data into database only if image upload was successful
    if ($image_uploaded) {
        $sql = "INSERT INTO events (event_date, start_time, end_time, location, description, registration_url, images)
                VALUES ('$event_date', '$start_time', '$end_time', '$location', '$description', '$registration_url', '$target_file')";
    } else {
        $sql = "INSERT INTO events (event_date, start_time, end_time, location, description, registration_url)
                VALUES ('$event_date', '$start_time', '$end_time', '$location', '$description', '$registration_url')";
    }

    // Execute SQL query and handle insertion result
    if ($conn->query($sql) === TRUE) {
        echo "New event created successfully";
        header("Location: event.php"); // Redirect after successful insertion
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close(); // Close database connection
}
?>

