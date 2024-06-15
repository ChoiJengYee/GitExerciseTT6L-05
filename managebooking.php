<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add'])) {
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $visit_date = $_POST['visit_date'];
        $sql = "INSERT INTO bookings (fullname, email, visit_date) VALUES ('$fullname', '$email', '$visit_date')";
        $conn->query($sql);
    } elseif (isset($_POST['edit'])) {
        $id = $_POST['id'];
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $visit_date = $_POST['visit_date'];
        $sql = "UPDATE bookings SET fullname='$fullname', email='$email', visit_date='$visit_date' WHERE id=$id";
        $conn->query($sql);
    } elseif (isset($_POST['delete'])) {
        $id = $_POST['id'];
        $sql = "DELETE FROM bookings WHERE id=$id";
        $conn->query($sql);
    }
}

$sql = "
    SELECT fullname, email, visit_date, COUNT(*) AS num_places
    FROM bookings
    WHERE visit_date IN (
        SELECT visit_date
        FROM bookings
        GROUP BY visit_date, fullname
        HAVING COUNT(DISTINCT locationID) > 1
    )
    GROUP BY fullname, visit_date
    ORDER BY visit_date DESC
";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Bookings</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f0f0f0;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        form.inline-form {
            display: inline-block;
            margin-right: 10px;
        }
        .add-form {
            margin-bottom: 20px;
        }
        .back-button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-bottom: 20px;
            cursor: pointer;
        }
        .back-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Manage Bookings</h1>
    <h2>Bookings with Multiple Places in One Day</h2>
    <table>
        <tr>
            <th>Full Name</th>
            <th>Email</th>
            <th>Visit Date</th>
            <th>Number of Places</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['fullname']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['visit_date']; ?></td>
                <td><?php echo $row['num_places']; ?></td>
            </tr>
        <?php } ?>
    </table>

    <a href="admin_dashboard.php" class="back-button">Back to Dashboard</a>
</body>
</html>

<?php $conn->close(); ?>






















