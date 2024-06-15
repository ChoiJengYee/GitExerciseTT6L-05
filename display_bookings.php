<<<<<<< HEAD
<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT b.id, b.fullname, b.email, b.visit_date, l.name as location_name, b.status 
        FROM bookings b 
        LEFT JOIN locations l ON b.locationID = l.id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<div class='list-container'>";
    echo "<h2>Your list:</h2>";
    echo "<ul id='selectedOptions'>";
    while($row = $result->fetch_assoc()) {
        echo "<li>" . $row["fullname"] . " - " . $row["email"] . " - " . $row["visit_date"] . " - " . $row["location_name"] . " - " . $row["status"] . "</li>";
    }
    echo "</ul>";
    echo "</div>";
} else {
    echo "0 results";
}

$conn->close();
?>
=======
<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT b.id, b.fullname, b.email, b.visit_date, l.name as location_name, b.status 
        FROM bookings b 
        LEFT JOIN locations l ON b.locationID = l.id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<div class='list-container'>";
    echo "<h2>Your list:</h2>";
    echo "<ul id='selectedOptions'>";
    while($row = $result->fetch_assoc()) {
        echo "<li>" . $row["fullname"] . " - " . $row["email"] . " - " . $row["visit_date"] . " - " . $row["location_name"] . " - " . $row["status"] . "</li>";
    }
    echo "</ul>";
    echo "</div>";
} else {
    echo "0 results";
}

$conn->close();
?>
>>>>>>> adbbb08a8ff8ca676f705b645a33d15c0c9dae3e
