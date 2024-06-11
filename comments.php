<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Comments</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 24px;
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
            margin-right: 10px;
        }
        select, input[type="submit"] {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-right: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f0f0f0;
        }
        .btn-delete {
            color: #fff;
            background-color: #ff5c5c;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        .btn-delete:hover {
            background-color: #ff3333;
        }
        .back-link {
            display: inline-block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #fff;
            background-color: #4CAF50;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        .back-link:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Manage Comments</h1>
        <form method="post" action="">
            <label for="location">Select Location:</label>
            <select name="location" id="location">
                <option value="">All Locations</option>
                <?php
                // Include database connection
                include_once 'config.php';

                // Fetch all locations from the database
                $sql_locations = "SELECT id, locationName FROM locations";
                $result_locations = $conn->query($sql_locations);

                // Output options for locations
                while($row = $result_locations->fetch_assoc()) {
                    echo "<option value='" . $row['id'] . "'>" . $row['locationName'] . "</option>";
                }
                ?>
            </select>
            <input type="submit" value="Filter">
        </form>

        <?php
        if(isset($_POST['location']) && is_numeric($_POST['location'])) {
            $location_id = $_POST['location'];
            // Fetch comments for the selected location
            $sql_comments = "SELECT comments.id, comments.comment, comments.created_at, locations.locationName 
                             FROM comments 
                             INNER JOIN locations ON comments.locationID = locations.id
                             WHERE comments.locationID = $location_id";
            $result_comments = $conn->query($sql_comments);
        } else {
            // Fetch all comments if no location is selected
            $sql_comments = "SELECT comments.id, comments.comment, comments.created_at, locations.locationName 
                             FROM comments 
                             INNER JOIN locations ON comments.locationID = locations.id";
            $result_comments = $conn->query($sql_comments);
        }

        // Display comments in a table
        if ($result_comments->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Location</th><th>Comment</th><th>Created At</th><th>Action</th></tr>";
            while($row = $result_comments->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["locationName"] . "</td>";
                echo "<td>" . $row["comment"] . "</td>";
                echo "<td>" . $row["created_at"] . "</td>";
                echo "<td><a class='btn-delete' href='delete_comment.php?id=" . $row["id"] . "' onclick='return confirm(\"Are you sure you want to delete this comment?\")'>Delete</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No comments found.";
        }
        ?>

        <a class="back-link" href="admin_dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>


