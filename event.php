<?php
include 'config2.php';

$sql = "SELECT * FROM events";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Events</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1 class="mt-5">Manage Events</h1>
    <a href="add_event.html" class="btn btn-primary">Add New Event</a>
    <a href="admin_dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Event Date</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Location</th>
                <th>Description</th>
                <th>Registration URL</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['event_date'] . "</td>";
                    echo "<td>" . $row['start_time'] . "</td>";
                    echo "<td>" . $row['end_time'] . "</td>";
                    echo "<td>" . $row['location'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "<td><a href='" . $row['registration_url'] . "' target='_blank'>Link</a></td>";
                    echo "<td><img src='" . $row['images'] . "' alt='Event Image' style='max-width: 100px;'></td>";
                    echo "<td><a href='delete_event.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm'>Delete</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No events found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>

<?php
$conn->close();
?>

