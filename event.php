<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Event</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
    }

    h2 {
        color: #333;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th, td {
        border: 1px solid #ccc;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f4f4f4;
    }

    th, td {
        transition: background-color 0.3s ease;
    }

    tbody tr:nth-child(odd) {
        background-color: #f9f9f9;
    }

    tbody tr:hover {
        background-color: #f1f1f1;
    }

    button {
        padding: 6px 12px;
        margin: 2px;
        border: none;
        background-color: #007BFF;
        color: white;
        cursor: pointer;
        border-radius: 4px;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #b30000;
    }

    button:focus {
        outline: none;
    }

    button.add-button {
        background-color: #28a745;
    }

    button.add-button:hover {
        background-color: #218838;
    }
    </style>
</head>
<body>
    <h1>Manage Event</h1>
    <a href="add_event.html"><button class="add-button">Add Event</button></a>
    <a href="admin_dashboard.php"><button>Back to Dashboard</button></a>
    <table border="1">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'config2.php';
            $sql = "SELECT * FROM events";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['title'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "<td>" . $row['event_date'] . "</td>";
                    echo "<td>";
                    echo "<a href='edit_event.php?id=" . $row['id'] . "'>Edit</a>";
                    echo " | ";
                    echo "<a href='delete_event.php?id=" . $row['id'] . "'>Delete</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No events found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
