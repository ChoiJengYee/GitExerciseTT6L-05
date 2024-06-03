<?php
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] !== "DELETE") {
    http_response_code(405); 
    echo json_encode(["error" => "Invalid request method"]);
    exit();
}

$input = json_decode(file_get_contents("php://input"), true);

$type = $input['type'] ?? '';
$id = $input['id'] ?? '';

if (empty($type) || empty($id)) {
    http_response_code(400); 
    echo json_encode(["error" => "Missing type or id"]);
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "campus_information";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    http_response_code(500); 
    echo json_encode(["error" => "Connection failed: " . $conn->connect_error]);
    exit();
}

$table = '';
if ($type === 'building') {
    $table = 'buildings';
} elseif ($type === 'faculty') {
    $table = 'faculties';
} else {
    http_response_code(400); 
    echo json_encode(["error" => "Invalid type"]);
    $conn->close();
    exit();
}

$sql = "DELETE FROM $table WHERE id = ?";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    http_response_code(500);
    echo json_encode(["error" => "SQL error: " . $conn->error]);
    $conn->close();
    exit();
}

$stmt->bind_param("i", $id);
if ($stmt->execute() === TRUE) {
    http_response_code(200);
    echo json_encode(["success" => "Record deleted successfully"]);
} else {
    http_response_code(500); 
    echo json_encode(["error" => "Error deleting record: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>





