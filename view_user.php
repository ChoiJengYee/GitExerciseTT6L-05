<?php
include 'config.php'; 

$sql = "SELECT id, name, email, image FROM user";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die('Error fetching data: ' . mysqli_error($conn));
}

echo "<table>";
echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Image</th><th>Actions</th></tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo "<td><img src='uploaded_img/" . $row['image'] . "' alt='" . $row['name'] . "' width='100'></td>";
    echo "<td>";
    echo "<a href='edit_user.php?id=" . $row['id'] . "'>Edit</a> | ";
    echo "<a href='suspend_user.php?id=" . $row['id'] . "'>Suspend</a> | ";
    echo "<a href='delete_user.php?id=" . $row['id'] . "'>Delete</a>";
    echo "</td>";
    echo "</tr>";
}

echo "</table>";

mysqli_free_result($result);

mysqli_close($conn);
?>
