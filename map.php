<!DOCTYPE html>
<html>
<head>
    <title>MMU Cyberjaya Map</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        body, html {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        #map {
            height: 100%;
            width: 100%;
        }
        h1 {
            text-align: center;
            margin: 20px 0;
            color: #333;
        }
        .comment-form {
            display: none;
            margin-top: 10px;
        }
        .popup-content {
            max-width: 250px;
            text-align: center;
        }
        .popup-content h2 {
            margin: 5px 0;
            color: #333;
        }
        .popup-content p {
            margin: 10px 0;
            color: #666;
        }
        .popup-content button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }
        .popup-content button:hover {
            background-color: #0056b3;
        }
        .comment-form textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            resize: none;
        }
        .comment-form input[type="submit"] {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }
        .comment-form input[type="submit"]:hover {
            background-color: #218838;
        }
        .comments {
            margin-top: 10px;
        }
        .comments p {
            margin: 5px 0;
            color: #666;
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
                    <div class="popup-content">
                        <h2>${location.locationName}</h2>
                        <p>${location.description}</p>
                        <button onclick="toggleCommentForm(${location.id})">Add Comment</button>
                        <form class="comment-form" id="commentForm_${location.id}" onsubmit="submitComment(event, ${location.id})">
                            <textarea id="commentText_${location.id}" placeholder="Enter your comment"></textarea><br>
                            <input type="submit" value="Submit">
                        </form>
                        <div class="comments" id="comments_${location.id}"></div> <!-- Container for comments -->
                    </div>
                `;
                circle.bindPopup(popupContent).openPopup();

                // Fetch comments for each location when marker is clicked
                circle.on('click', function() {
                    fetchComments(location.id); // Pass location ID to fetch comments
                });
            });
        });

</script>
</body>
</html>

