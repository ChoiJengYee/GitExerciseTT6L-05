<!DOCTYPE html>
<html>
<head>
    <title>MMU Cyberjaya Map</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 0;
            padding: 0;
        }
        #map {
            height: 500px;
        }
    </style>
</head>
<body>
    <div class="search-container">
      <input type="text" id="search-input" placeholder="Search...">
      <button onclick="search()">Search</button>
    </div>
    <div id="search-results">
      <!-- Search results will be displayed here -->
    </div>

    <h1>MMU Cyberjaya Map</h1>
    <div id="map"></div>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([2.928015, 101.641714], 17);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var locations = [
            {lat: 2.927550, lng: 101.642350, title: "Central Lecture Complex (CLC)", description: "Fun fact: There are always food stalls outside eheh."},
            {lat: 2.928900, lng: 101.642020, title: "Dewan Tun Censalor (DTC)", description: "Fun fact: This hall can fill around 500 people."},
            {lat: 2.928600, lng: 101.641254, title: "Faculty of Computing and Informatics (FCI)", description: "Fun fact: NO IDEA"},
            {lat: 2.926100, lng: 101.642700, title: "Faculty of Creative Multimedia (FCM)", description: "Fun fact: FAC IS ALSO HERE!!!"},
            {lat: 2.929655, lng: 101.6411300, title: "Faculty of Management (FOM)", description: "Fun fact: IDONTKNOW"},
            {lat: 2.926255, lng: 101.641290, title: "Faculty of Engineering", description: "Fun fact: EMMMMMM"},
            {lat: 2.927500, lng: 101.641750, title: "Siti Hasmah Digital Library and Learning Point", description: "Fun fact: Always full of people so you have to come early to at least get a seat."},
            {lat: 2.927800, lng: 101.643050, title: "Starbee", description: "Fun fact: You have to climb so many staircases to get back to other places after you eat :P"},
            {lat: 2.928400, lng: 101.643500, title: "Swimming Pool Complex", description: "Fun fact: There are always people from other schools coming here to rent/use the swimming pool."},
            {lat: 2.927800, lng: 101.644100, title: "Stadium", description: "Fun fact: DK no see before."},
            {lat: 2.928000, lng: 101.642300, title: "Multipurpose Hall (MPH)", description: "Fun fact: For exam purposes, I think?"},
            {lat: 2.924900, lng: 101.645600, title: "HB1", description: "Fun fact: For boys only."},
            {lat: 2.925200, lng: 101.644920, title: "HB2", description: "Fun fact: For boys only."},
            {lat: 2.925200, lng: 101.643850, title: "HB2", description: "Fun fact: For girls only."},
            {lat: 2.925900, lng: 101.644500, title: "HB2", description: "Fun fact: For girls only."}
        ];

        locations.forEach(function(location) {
            var circle = L.circleMarker([location.lat, location.lng], {
                color: 'blue',
                fillColor: '#0000FF',
                fillOpacity: 0.5,
                radius: 15
            }).addTo(map);

            var popupContent = `
                <h2>${location.title}</h2>
                <p>${location.description}</p>
                <button onclick="toggleCommentForm('${location.title}')">Add Comment</button>
                <form class="comment-form" onsubmit="submitComment(event, '${location.title}')">
                    <textarea id="commentText" placeholder="Enter your comment"></textarea><br>
                    <input type="submit" value="Submit">
                </form>
            `;
            circle.bindPopup(popupContent).openPopup();
        });

        function toggleCommentForm(location) {
            // Toggle the display of the comment form if needed
        }

        function submitComment(event, location) {
            event.preventDefault();
            var commentText = event.target.querySelector('#commentText').value;

            if (commentText.trim() === '') {
                alert('Comment cannot be empty.');
                return;
            }

            var formData = new FormData();
            formData.append('locationID', location);
            formData.append('comment', commentText);

            fetch('submit_comment.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                alert(data);
                event.target.reset();
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    </script>
</body>
</html>
