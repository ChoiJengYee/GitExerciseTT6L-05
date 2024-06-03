<?php

include 'config.php';

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    // Execute SQL statement
    if ($stmt->execute() === TRUE) {
        echo "Message sent successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
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
</body>
</html>


<style>
*{
    margin:0;
    padding:0;
    box-sizing: border-box;
}

body{
    font-family: 'Outfit';
    background: linear-gradient(#ffdad5, #fff7f9);
}

.contact-container{
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: space-evenly;
}

.contact-left{
    display: flex;
    flex-direction: column;
    align-items: start;
    gap: 20px;
}

.contact-left-title h2{
    font-weight: 600;
    color: #a363aa;
    font-size: 40px;
    margin-bottom:5px;
}

.contact-left-title hr{
    border:none;
    width:120px;
    height:5px;
    background-color: #a363aa;
    border-radius: 10px;
    margin-bottom: 20px;
}

.contact-inputs{
    width: 400px;
    height:50px;
    border:none;
    outline:none;
    padding-left:25px;
    font-weight:500;
    color:#666;
    border-radius: 50px;
}

.contact-left textarea{
    height: 140px;
    padding-top: 15px;
    border-radius: 20px;
}

.contact-inputs:focus{
    border: 2px solid #ff994f;
}

.contact-inputs::placeholder{
    color:#a9a9a9;
}

.contact-left button{
    display:flex;
    align-items: center;
    padding:15px 30px;
    font-size:16px;
    color:#fff;
    gap:10px;
    border:none;
    border-radius:50px;
    background:linear-gradient(270deg,#ff994f,#fa6d86);
    cursor: pointer;
}

.contact-right img{
    width: 250px;
}

@media(max-width:800px){
    .contact-inputs{
        width:80vw;
    }
    .contact-right{
        display: none;
    }
}
</style> 