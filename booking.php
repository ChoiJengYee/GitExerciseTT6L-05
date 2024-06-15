<<<<<<< HEAD
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Travel Booking</title>
    <style>
        /* Your existing CSS styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('mmuimage.jpg'); /* Replace with your background image path */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        .container {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }
        .form-container, .list-container {
            width: 45%;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.9); /* Add transparency */
        }
        .form-container {
            max-width: 600px;
        }
        .list-container {
            max-height: 400px;
            overflow-y: auto;
        }
        a:hover {
            color: hsl(118, 76%, 48%);
        }
        h1, h2 {
            text-align: center;
            color: #333;
        }
        label {
            font-weight: bold;
            color: #333;
        }
        input[type="text"], input[type="date"], select {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        button {
            padding: 12px 24px;
            font-size: 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button.centered {
            display: block;
            margin: 20px auto;
        }
        .list-container table {
            width: 100%;
            border-collapse: collapse;
        }
        .list-container th, .list-container td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        .list-container th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <h1>Welcome to MMU!</h1>

    <h2>You can plan your trip planning.</h2>

    <div class="container">
        <!-- Form container -->
        <div class="form-container">
            <form id="bookingForm" action="submit_booking.php" method="post">
                <label for="fullname">Fullname:</label>
                <input type="text" id="fullname" name="fullname" required>

                <label for="email">Email:</label>
                <input type="text" id="email" name="email" required>

                <label for="visit_date">Visit Date:</label>
                <input type="date" id="visit_date" name="visit_date" required>
                
                <div id="optionsForm">
                    <div class="checkbox-container">
                        <!-- Example checkboxes -->
                        <label>
                        <input type="checkbox" name="option[]" value="Dewan Tun Censalor (DTC)"><a href="dtc.html">DTC</a>
                    </label>
                    <label>
                        <input type="checkbox" name="option[]" value="Faculty of Computing and Informatics (FCI)"><a href="fci.html">FCI</a>
                    </label>
                    <label>
                        <input type="checkbox" name="option[]" value="Faculty of Creative Multimedia (FCM)"><a href="fcmfac.html">FCM & FAC & FCA</a>
                    </label>
                    <label>
                        <input type="checkbox" name="option[]" value="Faculty of Engineering"><a href="foe.html">FOE</a>
                    </label>
                    <label>
                        <input type="checkbox" name="option[]" value="Faculty of Management (FOM)"><a href="fom.html">FOM</a>
                    </label>
                    <label>
                        <input type="checkbox" name="option[]" value="Multipurpose Hall (MPH)"><a href="mph.html">MPH</a>
                    </label>
                    <label>
                        <input type="checkbox" name="option[]" value="Siti Hasmah Digital Library and Learning Point"><a href="lp_shdl.html">SHDL&LP</a>
                    </label>
                    <label>
                        <input type="checkbox" name="option[]" value="Starbee"><a href="starbee.html">Starbees</a>
                    </label>
                    <label>
                        <input type="checkbox" name="option[]" value="Swimming Pool Complex"><a href="swimmingpoolcomplex.html">Swimming Pool</a>
                    </label>
                    <label>
                        <input type="checkbox" name="option[]" value="HB1"><a href="hb1hb2hb3hb4.html">HB1</a>
                    </label>
                    <label>
                        <input type="checkbox" name="option[]" value="HB2"><a href="hb1hb2hb3hb4.html">HB2</a>
                    </label>
                    <label>
                        <input type="checkbox" name="option[]" value="HB3"><a href="hb1hb2hb3hb4.html">HB3</a>
                    </label>
                    <label>
                        <input type="checkbox" name="option[]" value="HB4"><a href="hb1hb2hb3hb4.html">HB4</a>
                    </label>
                    <label>
                        <input type="checkbox" name="option[]" value="Stadium"><a href="mmustadium.html">Stadium</a>
                    </label>
                    <label>
                        <input type="checkbox" name="option[]" value="Central Lecture Complex (CLC)"><a href="clc.html">Common Lecture Complex</a>
                    </label>
                    </div>
                    <button type="submit" class="centered">Submit</button>
                </div>
            </form>
        </div>
        
        <!-- List container -->
        <div id="bookingList" class="list-container">
            <!-- List of bookings will be displayed here -->
        </div>
    </div>

    <!-- Popup notification -->
    <div id="bookingSuccessPopup" class="popup">
        <p>Booking Successful!</p>
    </div>
  
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#bookingForm').submit(function(event) {
                event.preventDefault(); // Prevent default form submission

                // Submit the form via AJAX
                $.ajax({
                    type: 'POST',
                    url: 'submit_booking.php',
                    data: $('#bookingForm').serialize(),
                    success: function(response) {
                        // Show the booking success popup
                        $('#bookingSuccessPopup').fadeIn().delay(2000).fadeOut();
                        // Display the list of bookings after success
                        $('#bookingList').html(response);
                        // Clear form fields
                        $('#fullname').val('');
                        $('#email').val('');
                        $('#visit_date').val('');
                        $('input[type=checkbox]').prop('checked', false);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        // Handle errors if needed
                    }
                });
            });
        });
    </script>

</body>
</html>
=======
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Travel Booking</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('mmu image.jpg'); /* Ensure this path is correct */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed; /* Keeps the background fixed */
        }
        .form-container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.9); /* Add transparency */
        }
        a:hover {
            color: hsl(118, 76%, 48%); 
        }
        h1, h2 {
            text-align: center;
            color: #333;
        }
        label {
            font-weight: bold;
            color: #333;
        }
        input[type="text"], input[type="date"], select {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        button {
            padding: 12px 24px;
            font-size: 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button.centered {
            display: block;
            margin: 20px auto;
        }
        #optionsForm {
            border: 1px solid #000;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9); /* Add transparency */
            border-radius: 5px;
            margin-top: 20px;
        }
        .checkbox-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .checkbox-container label {
            width: 30%;
            margin-bottom: 10px;
            color: #333;
        }
        .checkbox-container a {
            text-decoration: none;
            color: #007bff;
        }
        .checkbox-container a:hover {
            color: hsl(118, 76%, 48%); 
        }
        .list-container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.9); /* Add transparency */
        }
        .list-container ul {
            list-style-type: none;
            padding: 0;
        }
        .list-container li {
            display: flex;
            justify-content: space-between;
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }
        .list-container li button {
            background-color: #ff4c4c;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <h1>Welcome to MMU!</h1>

    <h2>You can plan your trip planning.</h2>

    <div class="form-container">
        <form action="submit_booking.php" method="post">
            <label for="fullname">Fullname:</label>
            <input type="text" id="fullname" name="fullname" required>

            <label for="email">Email:</label>
            <input type="text" id="email" name="email" required>

            <label for="visit_date">Visit Date:</label>
            <input type="date" id="visit_date" name="visit_date" required>
            
            <div id="optionsForm" class="form-container">
                <div class="checkbox-container">
                    <label>
                        <input type="checkbox" name="option[]" value="Dewan Tun Censalor (DTC)"><a href="dtc.html">DTC</a>
                    </label>
                    <label>
                        <input type="checkbox" name="option[]" value="Faculty of Computing and Informatics (FCI)"><a href="fci.html">FCI</a>
                    </label>
                    <label>
                        <input type="checkbox" name="option[]" value="Faculty of Creative Multimedia (FCM)"><a href="fcmfac.html">FCM & FAC & FCA</a>
                    </label>
                    <label>
                        <input type="checkbox" name="option[]" value="Faculty of Engineering"><a href="foe.html">FOE</a>
                    </label>
                    <label>
                        <input type="checkbox" name="option[]" value="Faculty of Management (FOM)"><a href="fom.html">FOM</a>
                    </label>
                    <label>
                        <input type="checkbox" name="option[]" value="Multipurpose Hall (MPH)"><a href="mph.html">MPH</a>
                    </label>
                    <label>
                        <input type="checkbox" name="option[]" value="Siti Hasmah Digital Library and Learning Point"><a href="lp_shdl.html">SHDL&LP</a>
                    </label>
                    <label>
                        <input type="checkbox" name="option[]" value="Starbee"><a href="starbee.html">Starbees</a>
                    </label>
                    <label>
                        <input type="checkbox" name="option[]" value="Swimming Pool Complex"><a href="swimmingpoolcomplex.html">Swimming Pool</a>
                    </label>
                    <label>
                        <input type="checkbox" name="option[]" value="HB1"><a href="hb1hb2hb3hb4.html">HB1</a>
                    </label>
                    <label>
                        <input type="checkbox" name="option[]" value="HB2"><a href="hb1hb2hb3hb4.html">HB2</a>
                    </label>
                    <label>
                        <input type="checkbox" name="option[]" value="HB3"><a href="hb1hb2hb3hb4.html">HB3</a>
                    </label>
                    <label>
                        <input type="checkbox" name="option[]" value="HB4"><a href="hb1hb2hb3hb4.html">HB4</a>
                    </label>
                    <label>
                        <input type="checkbox" name="option[]" value="Stadium"><a href="mmustadium.html">Stadium</a>
                    </label>
                    <label>
                        <input type="checkbox" name="option[]" value="Central Lecture Complex (CLC)"><a href="clc.html">Common Lecture Complex</a>
                    </label>
                </div>
                <button type="submit" class="centered">Submit</button>
            </div>
        </form>
    </div>
  
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        var markers = {};

        document.getElementById('optionsForm').addEventListener('submit', function(event) {
            event.preventDefault();

            var checkboxes = document.querySelectorAll('input[name="option[]"]');

            checkboxes.forEach(function(checkbox) {
                var lat = checkbox.getAttribute('data-lat');
                var lng = checkbox.getAttribute('data-lng');
                var name = checkbox.value;

                if (checkbox.checked) {
                    if (!markers[name]) {
                        markers[name] = { lat: lat, lng: lng, name: name };
                    }
                } else {
                    delete markers[name];
                }
            });

            updateSelectedOptions();
        });

        function updateSelectedOptions() {
            var selectedOptionsList = document.getElementById('selectedOptions');
            selectedOptionsList.innerHTML = '';

            for (var name in markers) {
                if (markers.hasOwnProperty(name)) {
                    var listItem = document.createElement('li');
                    var deleteButton = document.createElement('button');
                    deleteButton.textContent = 'Delete';
                    deleteButton.setAttribute('data-name', name); // Store the name as data attribute
                    deleteButton.addEventListener('click', function() {
                        var markerName = this.getAttribute('data-name');
                        delete markers[markerName];
                        updateSelectedOptions(); // Update the list after deletion
                        // Optionally, you can trigger an action to uncheck the corresponding checkbox
                        var checkbox = document.querySelector('input[value="' + markerName + '"]');
                        if (checkbox) {
                            checkbox.checked = false;
                        }
                    });
                    listItem.textContent = name;
                    listItem.appendChild(deleteButton);
                    selectedOptionsList.appendChild(listItem);
                }
            }
        }
    </script>
</body>
</html>
>>>>>>> adbbb08a8ff8ca676f705b645a33d15c0c9dae3e
