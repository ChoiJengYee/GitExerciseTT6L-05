<?php
// Connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'user_db') or die('Connection failed: ' . mysqli_connect_error());

// Array of locations
$locations = [
    ["lat" => 2.927550, "lng" => 101.642350, "title" => "Central Lecture Complex (CLC)", "description" => "Fun fact: There are always food stalls outside eheh."],
    ["lat" => 2.928900, "lng" => 101.642020, "title" => "Dewan Tun Censalor (DTC)", "description" => "Fun fact: This hall can fill around 500 people."],
    ["lat" => 2.928600, "lng" => 101.641254, "title" => "Faculty of Computing and Informatics (FCI)", "description" => "Fun fact: NO IDEA"],
    ["lat" => 2.926100, "lng" => 101.642700, "title" => "Faculty of Creative Multimedia (FCM)", "description" => "Fun fact: FAC IS ALSO HERE!!!"],
    ["lat" => 2.929655, "lng" => 101.6411300, "title" => "Faculty of Management (FOM)", "description" => "Fun fact: IDONTKNOW"],
    ["lat" => 2.926255, "lng" => 101.641290, "title" => "Faculty of Engineering", "description" => "Fun fact: EMMMMMM"],
    ["lat" => 2.927500, "lng" => 101.641750, "title" => "Siti Hasmah Digital Library and Learning Point", "description" => "Fun fact: Always full of people so you have to come early to at least get a seat."],
    ["lat" => 2.927800, "lng" => 101.643050, "title" => "Starbee", "description" => "Fun fact: You have to climb so many staircases to get back to other places after you eat :P"],
    ["lat" => 2.928400, "lng" => 101.643500, "title" => "Swimming Pool Complex", "description" => "Fun fact: There are always people from other schools coming here to rent/use the swimming pool."],
    ["lat" => 2.927800, "lng" => 101.644100, "title" => "Stadium", "description" => "Fun fact: DK no see before."],
    ["lat" => 2.928000, "lng" => 101.642300, "title" => "Multipurpose Hall (MPH)", "description" => "Fun fact: For exam purposes, I think?"],
    ["lat" => 2.924900, "lng" => 101.645600, "title" => "HB1", "description" => "Fun fact: For boys only."],
    ["lat" => 2.925200, "lng" => 101.644920, "title" => "HB2", "description" => "Fun fact: For boys only."],
    ["lat" => 2.925200, "lng" => 101.643850, "title" => "HB3", "description" => "Fun fact: For girls only."],
    ["lat" => 2.925900, "lng" => 101.644500, "title" => "HB4", "description" => "Fun fact: For girls only."]
];

// Prepare SQL statement to insert location
$sql = "INSERT INTO locations (locationName, lat, lng, description) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

// Loop through the locations and insert them into the database
foreach ($locations as $location) {
    $locationName = $location['title'];
    $lat = $location['lat'];
    $lng = $location['lng'];
    $description = $location['description'];

    $stmt->bind_param("sdds", $locationName, $lat, $lng, $description);
    $stmt->execute();
    echo "Inserted location: " . $locationName . " with ID: " . $stmt->insert_id . "<br>";
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
