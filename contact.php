<?php

include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    $stmt = $conn->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute() === TRUE) {
        echo "Message sent successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="contact-container">
        <form action="contact.php" method="POST" class="contact-left">
            <div class="contact-left-title">
                <h2>Get In Touch</h2>
                <hr>
            </div>
            <input type="text" name="name" placeholder="Your Name" class="contact-inputs" required>
            <input type="email" name="email" placeholder="Your Email" class="contact-inputs" required>
            <textarea name="message" placeholder="Your Message" class="contact-inputs" required></textarea>
            <button type="submit">Submit</button>
        </form>
        <div class="contact-right">
            <img src="contact-us.png" alt="">
        </div>
    </div>

    <div class="popup" id="popup">
        <div class="popup-content">
            <span class="close" id="close-popup">&times;</span>
            <p>Message Sent Successfully!</p>
        </div>
    </div>

    <a href="admin_dashboard.php" class="back-to-dashboard">Back to Dashboard</a>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('.contact-left form');
            const popup = document.getElementById('popup');
            const closePopupButton = document.getElementById('close-popup');

            form.addEventListener('submit', function(event) {
                event.preventDefault();
                setTimeout(() => {
                    popup.style.display = 'block';
                }, 500);
            });

            closePopupButton.addEventListener('click', function() {
                popup.style.display = 'none';
            });
        });
    </script>
</body>
</html>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Outfit';
    background: linear-gradient(#ffdad5, #fff7f9);
}

.contact-container {
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: space-evenly;
}

.contact-left {
    display: flex;
    flex-direction: column;
    align-items: start;
    gap: 20px;
}

.contact-left-title h2 {
    font-weight: 600;
    color: #a363aa;
    font-size: 40px;
    margin-bottom: 5px;
}

.contact-left-title hr {
    border: none;
    width: 120px;
    height: 5px;
    background-color: #a363aa;
    border-radius: 10px;
    margin-bottom: 20px;
}

.contact-inputs {
    width: 400px;
    height: 50px;
    border: none;
    outline: none;
    padding-left: 25px;
    font-weight: 500;
    color: #666;
    border-radius: 50px;
}

.contact-left textarea {
    height: 140px;
    padding-top: 15px;
    border-radius: 20px;
}

.contact-inputs:focus {
    border: 2px solid #ff994f;
}

.contact-inputs::placeholder {
    color: #a9a9a9;
}

.contact-left button {
    display: flex;
    align-items: center;
    padding: 15px 30px;
    font-size: 16px;
    color: #fff;
    gap: 10px;
    border: none;
    border-radius: 50px;
    background: linear-gradient(270deg, #ff994f, #fa6d86);
    cursor: pointer;
}

.contact-right img {
    width: 250px;
}

@media(max-width: 800px) {
    .contact-inputs {
        width: 80vw;
    }

    .contact-right {
        display: none;
    }
}

.back-to-dashboard {
    display: inline-block;
    padding: 10px 20px;
    margin-top: 20px;
    background-color: #007bff;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
}

.back-to-dashboard:hover {
    background-color: #0056b3;
}

.popup {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    z-index: 1000;
}

.popup-content {
    text-align: center;
}

.close {
    position: absolute;
    top: 10px;
    right: 10px;
    cursor: pointer;
    font-size: 20px;
    color: #333;
}

</style> 