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
        .comment-form {
            display: none;
        }
    </style>
</head>
<body>
    <h1>MMU Cyberjaya Map</h1>
    <div id="map"></div>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([2.928015, 101.641714], 17);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        function toggleCommentForm(locationID) {
            var form = document.getElementById(`commentForm_${locationID}`);
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        }

        function submitComment(event, locationID) {
            event.preventDefault();
            var commentText = document.getElementById(`commentText_${locationID}`).value;

            if (commentText.trim() === '') {
                alert('Comment cannot be empty.');
                return;
            }

            var formData = new FormData();
            formData.append('locationID', locationID);
            formData.append('comment', commentText);

            fetch('submit_comments.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                alert(data);
                document.getElementById(`commentText_${locationID}`).value = '';
                // Fetch updated comments after submitting a new one
                fetchComments(locationID);
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        function fetchComments(locationID) {
            fetch(`fetch_comments.php?locationID=${locationID}`)
                .then(response => response.json())
                .then(comments => {
                    var commentsDiv = document.getElementById(`comments_${locationID}`);
                    commentsDiv.innerHTML = ''; // Clear previous comments
                    comments.forEach(comment => {
                        var p = document.createElement('p');
                        p.textContent = comment.comment + " - " + comment.created_at; // Display comment and creation time
                        commentsDiv.appendChild(p);
                    });
                });
        }

        // Fetch locations and add markers
        fetch('fetch_locations.php')
            .then(response => response.json())
            .then(locations => {
                locations.forEach(location => {
                    var circle = L.circleMarker([parseFloat(location.lat), parseFloat(location.lng)], {
                        color: 'blue',
                        fillColor: '#0000FF',
                        fillOpacity: 0.5,
                        radius: 15
                    }).addTo(map);

                    var popupContent = `
                        <h2>${location.locationName}</h2>
                        <p>${location.description}</p>
                        <button onclick="toggleCommentForm(${location.id})">Add Comment</button>
                        <form class="comment-form" id="commentForm_${location.id}" onsubmit="submitComment(event, ${location.id})">
                            <textarea id="commentText_${location.id}" placeholder="Enter your comment"></textarea><br>
                            <input type="submit" value="Submit">
                        </form>
                        <div id="comments_${location.id}"></div>
                    `;
                    circle.bindPopup(popupContent).openPopup();

                    // Fetch comments for each location
                    circle.on('click', function() {
                        fetchComments(location.id);
                    });
                });
            });

    </script>
</body>
</html>
