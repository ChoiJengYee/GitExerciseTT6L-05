<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Messages</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
    }

    h1 {
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

    .replied-button {
        padding: 6px 12px;
        margin: 2px;
        border: none;
        background-color: #28a745;
        color: white;
        cursor: pointer;
        border-radius: 4px;
        transition: background-color 0.3s ease;
    }

    .replied-button:hover {
        background-color: #218838;
    }

    .replied-button:focus {
        outline: none;
    }

    .message-column {
        width: 40%; 
        max-width: 500px; 
        word-wrap: break-word; 
    }
    </style>
</head>
<body>
    <h1>Manage Messages</h1>
    <a href="admin_dashboard.php"><button>Back to Dashboard</button></a>
    <table border="1">
        <thead>
            <tr>
                <th>Name</th>
                <th>E-mail</th>
                <th class="message-column">Message</th> <!-- Add the class to the message column -->
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
            include 'config.php';
                $sql = "SELECT * FROM messages";
                $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td><a href='mailto:" . $row['email'] . "'>" . $row['email'] . "</a></td>";
                    echo "<td class='message-column'>" . $row['message'] . "</td>"; // Add the class to the message cell
                    echo "<td>" . $row['created_at'] . "</td>";
                    echo "<td>";
                    echo "<a href='replied_message.php?id=" . $row['id'] . "'><button class='replied-button'>Replied</button></a>";
                    echo "</td>";
                    echo "</tr>";
                    }
            } else {
            echo "<tr><td colspan='5'>No messages found.</td></tr>";
            }
        ?>
        </tbody>
    </table>
</body>
</html>






