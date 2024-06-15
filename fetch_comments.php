<?php
include 'config.php';

$locationID = $_GET['locationID'] ?? null;

if ($locationID === null) {
    echo json_encode(['error' => 'locationID parameter is missing']);
    exit;
}

$sql = "SELECT comment, created_at FROM comments WHERE locationID = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    echo json_encode(['error' => 'SQL preparation failed']);
    exit;
}

$stmt->bind_param("i", $locationID);
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
