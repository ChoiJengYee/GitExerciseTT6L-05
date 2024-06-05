<?php
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$locationID = $_GET['locationID'];

$sql = "SELECT comment, created_at FROM comments WHERE locationID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $locationID);
$stmt->execute();
$result = $stmt->get_result();

$comments = [];

while ($row = $result->fetch_assoc()) {
    $comments[] = $row;
}

$stmt->close();
$conn->close();

header('Content-Type: application/json');
echo json_encode($comments);
?>
<?php
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$locationID = $_GET['locationID'];

$sql = "SELECT comment, created_at FROM comments WHERE locationID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $locationID);
$stmt->execute();
$result = $stmt->get_result();

$comments = [];

while ($row = $result->fetch_assoc()) {
    $comments[] = $row;
}

$stmt->close();
$conn->close();

header('Content-Type: application/json');
echo json_encode($comments);
?>
