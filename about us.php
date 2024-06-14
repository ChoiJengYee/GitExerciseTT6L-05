<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="icon" href="logommu.jpg">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Paytone+One&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="about.css">
</head>
<body>
    <div class="hero">
        <nav>
            <img src="logommu.jpg" class="logo">
            <div class="menu-container">
                <div class="menu">
                    <div class="menu-item">
                        <a href="home.php">Home</a>
                    </div>
                    <div class="menu-item">
                        <a href="index.php">Map</a>
                    </div>
                    <div class="menu-item">
                        <a href="booking.php">Booking</a>
                    </div>
                    <div class="menu-item">
                        Location
                        <div class="submenu">
                            <a href="dtc.html">Dewan Tun Cansellor</a>
                            <a href="chancellery.html">MMU Chancellery</a>
                            <a href="lp_shdl.html">Siti Hasmah Digital Library</a>
                            <a href="mph.html">Multipurpose Hall</a>
                            <a href="clc.html">Central Lecture Complex</a>
                            <a href="fci.html">Faculty of Computing and Informatics</a>
                            <a href="fcm.html">Faculty of Creative Multimedia</a>
                            <a href="foe.html">Faculty of Engineering</a>
                            <a href="fom.html">Faculty of Management</a>
                            <a href="fca.html">Faculty of Cinematic Arts</a>
                            <a href="fac.html">Faculty of Applied Communication</a>
                            <a href="hb1hb2hb3hb4.html">Hostels (HB1,HB2,HB3,HB4)</a>
                            <a href="starbee.html">Starbee Foodcourt</a>
                            <a href="mmustadium.html">Stadium</a>
                            <a href="swimmingpoolcomplex.html">Swimming Pool Complex</a>
                        </div>
                    </div>
                    <div class="menu-item">
                        <a href="EventCalendar.php">Event</a>
                    </div>
                    <div class="menu-item">
                        <a href="contact.php">Contact</a>
                    </div>
                    <div class="menu-item">
                        Profile
                        <div class="submenu">
                            <a href="update_profile.php">Manage Account</a>
                            <a href="homescreen.html">Sign Out</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>

    <section class="about">
        <div class="main">
            <img src="my pic.jpg" alt="My Photo">
            <div class="abt-text">
                <h1>About <span>Us</span></h1>
                <p>MMU CYBERJAYA CAMPUS VISIT SYSTEM is a travel website project developed by TT6L-05 using HTML, CSS, PHP and JavaScript.</p>
                <a href="https://chat.whatsapp.com/F2CIGYpVO6NF3eUUVTmu9k" class="connectbtn" target="_blank">Connect with us!</a>
                <div class="connect-section">
                    <div class="social-icons">
                        <a href="https://www.facebook.com/mmumalaysia" target="_blank"><i class='bx bxl-facebook'></i></a>
                        <a href="https://www.instagram.com/mmumalaysia/" target="_blank"><i class='bx bxl-instagram' ></i></a>
                        <a href="https://www.youtube.com/@mmumalaysiatv" target="_blank"><i class='bx bxl-youtube' ></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <section class="footer">
        <div class="foot">
            <div class="footer-content">
                <div class="footlinks">
                    <h4>Connect to MMU Social Media</h4>
                    <div class="social">
                        <a href="https://www.facebook.com/mmumalaysia" target="_blank"><img src="facebook-logo.jpg" alt="Facebook Logo"></a>
                        <a href="https://www.instagram.com/mmumalaysia/" target="_blank"><img src="ig-logo.png" alt="Instagram Logo"></a>
                        <a href="https://www.youtube.com/@mmumalaysiatv" target="_blank"><img src="youtube-logo.png" alt="YouTube Logo"></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="end">
            <p>Copyright © 2024 MMU CYBERJAYA CAMPUS VISIT SYSTEM<br>Website developed by: TT6L-05</p>
        </div>
    </section>
</body>
</html>


<style>
/* Reset and General Styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Poppins', sans-serif;
    background-color: #f9f9f9;
    color: #333;
    line-height: 1.6;
}

/* Navigation */
nav {
    background-color: #333;
    padding: 20px 10%;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.logo {
    width: 120px;
}

.menu-container {
    background-color: #548df7;
    padding: 20px;
    border-radius: 8px;
}

.menu {
    display: flex;
    justify-content: space-between;
}

.menu-item {
    position: relative;
    flex: 1;
    text-align: center;
    padding: 14px 16px;
    color: white;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.menu-item:hover {
    background-color: #416ab6;
}

/* Submenu */
.submenu {
    display: none;
    position: absolute;
    top: calc(100% + 10px);
    left: 50%; /* Center the submenu horizontally */
    transform: translateX(-50%); /* Center the submenu horizontally */
    background-color: #fff;
    min-width: 160px;
    box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
    z-index: 1;
    max-height: 300px;
    overflow-y: auto;
    opacity: 0; /* Hide submenu initially */
    pointer-events: none; /* Disable pointer events initially */
    transition: opacity 0.3s ease; /* Add transition for smoother appearance */
}

.menu-item:hover .submenu {
    display: block;
    opacity: 1; /* Ensure submenu is fully visible */
    pointer-events: auto; /* Enable pointer events */
    transition-delay: 0.2s; /* Add a delay before showing submenu */
}

.menu-item:not(:hover) .submenu {
    opacity: 0; /* Hide submenu with reduced opacity */
    pointer-events: none; /* Disable pointer events to prevent interaction */
}

.submenu a {
    color: #333;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
    transition: background-color 0.3s ease;
}

.submenu a:hover {
    background-color: #f1f1f1;
}

/* About Us Section */
.about {
    padding: 100px 0;
    text-align: center;
}

.about img {
    max-width: 100%;
    height: auto;
    margin-bottom: 30px;
    border-radius: 8px;
}

.abt-text {
    max-width: 600px;
    margin: 0 auto;
}

.abt-text h1 {
    font-size: 48px;
    color: #333;
    margin-bottom: 20px;
}

.abt-text h1 span {
    color: #fc0050;
}

.abt-text p {
    color: #666;
    font-size: 18px;
    margin-bottom: 40px;
}

.connectbtn {
    display: inline-block;
    background-color: #fc0050;
    font-size: 18px;
    color: white;
    font-weight: bold;
    padding: 15px 40px;
    border-radius: 30px;
    transition: background-color 0.3s ease;
    text-decoration: none;
}

.connectbtn:hover {
    background-color: #e60046;
    transform: translateY(-2px);
}

/* Footer */
.footer {
    background-color: #333;
    color: #fff;
    padding: 50px 0;
    text-align: center;
}

.footer-content {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    max-width: 1200px;
    margin: 0 auto;
}

.footlinks {
    margin-bottom: 30px;
}

.footlinks h4 {
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 15px;
    position: relative;
    color: #fc0050;
}

.footlinks h4::before {
    content: "";
    position: absolute;
    height: 2px;
    width: 50px;
    left: 0;
    bottom: -5px;
    background: #fc0050;
}

.footlinks ul li {
    margin-bottom: 10px;
}

.footlinks ul li a {
    color: #ccc;
    transition: color 0.3s ease;
}

.footlinks ul li a:hover {
    color: #fff;
}

/* Social Media Icons */
.social a {
    font-size: 20px;
    width: 40px; /* Adjusted width */
    height: 40px; /* Adjusted height */
    display: inline-flex;
    justify-content: center;
    align-items: center;
    color: #fff;
    border-radius: 50%;
    background-color: #416ab6;
    margin: 0 5px;
    transition: background-color 0.3s ease;
}

.social img {
    width: 25px; /* Adjusted width */
    height: 25px; /* Adjusted height */
    display: inline-block;
    margin: 0 5px;
}

.social a:hover {
    background-color: #548df7;
}

.end {
    margin-top: 30px;
    font-size: 14px;
    color: #ccc;
}

/* Responsive Design */
@media only screen and (max-width: 768px) {
    nav {
        padding: 20px 5%;
    }

    .logo {
        width: 100px;
    }

    .menu-item {
        padding: 14px 10px;
    }

    .submenu {
        top: calc(100% + 5px);
    }

    .footer-content {
        padding: 0 20px;
    }
}

/* Accessibility */
.abt-text h1,
.abt-text p {
    color: #333;
}

.footer,
.footer a {
    color: #fff;
}

</style>
