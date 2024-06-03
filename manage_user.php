<?php
include 'config.php';

$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die('Error fetching data: ' . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Accounts</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
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
        tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }
        tbody tr:hover {
            background-color: #f1f1f1;
        }
        .actions button {
            padding: 6px 12px;
            margin: 2px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }
        .edit-button {
            background-color: #007BFF;
            color: white;
        }
        .edit-button:hover {
            background-color: #0056b3;
        }
        .delete-button {
            background-color: #dc3545;
            color: white;
        }
        .delete-button:hover {
            background-color: #c82333;
        }
        .back-button {
            background-color: #6c757d;
            color: white;
        }
        .back-button:hover {
            background-color: #5a6268;
        }
    </style>
    <script>
        function editUser(id) {
            window.location.href = `edit_user.php?id=${id}`;
        }

        function deleteUser(id) {
            if (confirm('Are you sure you want to delete this user?')) {
                window.location.href = `delete_user.php?id=${id}`;
            }
        }
    </script>
</head>
<body>
    <h2>User Accounts</h2>
    <button class="back-button" onclick="window.location.href = 'admin_dashboard.php';">Back to Dashboard</button>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Display user data in table rows
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td><img src='uploaded_img/" . $row['image'] . "' alt='" . $row['name'] . "' width='100'></td>";
                echo "<td class='actions'>
                        <button class='edit-button' onclick='editUser(" . $row['id'] . ")'>Edit</button>
                        <button class='delete-button' onclick='deleteUser(" . $row['id'] . ")'>Delete</button>
                      </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>

<?php
// Free result set
mysqli_free_result($result);

// Close connection
mysqli_close($conn);
?>
