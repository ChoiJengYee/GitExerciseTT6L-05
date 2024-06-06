<?php
include 'config2.php';

$month = isset($_GET['month']) ? intval($_GET['month']) : date('m');
$year = isset($_GET['year']) ? intval($_GET['year']) : date('Y');

$sql = "SELECT id, title, description, event_date FROM events WHERE MONTH(event_date) = ? AND YEAR(event_date) = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $month, $year);
$stmt->execute();
$result = $stmt->get_result();

$events = array();
while ($row = $result->fetch_assoc()) {
    $events[] = $row;
}

$stmt->close();
$conn->close();

header('Content-Type: application/json');
echo json_encode($events);
?>
