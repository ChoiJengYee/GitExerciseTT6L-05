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
                        Map
                        <div class="submenu">
                            <a href="#">Interactive Map</a>
                            <a href="#">Comments</a>
                            <a href="#">Where U Are?</a>
                        </div>
                    </div>
                    <div class="menu-item">
                        <a href="booking.php">Bookings</a>
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
                        <a href="#">Event</a>
                    </div>
                    <div class="menu-item">
                        <a href="contact.php">Contact</a>
                    </div>
                    <div class="menu-item">
                        Profile
                        <div class="submenu">
                            <a href="update_profile.php">Manage Account</a>
                            <a href="mybooking.php">My Bookings</a>
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
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="register.php">Register</a></li>
                        <li><a href="about.html">About Us</a></li>
                        <li><a href="contact.html">Contact Us</a></li>
                    </ul>
                </div>
                <div class="footlinks">
                    <h4>Connect</h4>
                    <div class="social">
                        <a href="https://www.facebook.com/mmumalaysia" target="_blank"><i class='bx bxl-facebook'></i></a>
                        <a href="https://www.instagram.com/mmumalaysia/" target="_blank"><i class='bx bxl-instagram' ></i></a>
                        <a href="https://www.youtube.com/@mmumalaysiatv" target="_blank"><i class='bx bxl-youtube' ></i></a>
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
/* General styles */
* {
    margin: 0;
    padding: 0;
    font-family: 'Poppins', sans-serif;
    box-sizing: border-box;
}

/* Navigation */
nav {
    background: #333;
    width: 100%;
    padding: 10px 10%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: relative;
}

.logo {
    width: 120px;
}

/* Menu Container */
.menu-container {
    background-color: #548df7; /* Blue background */
    padding: 10px; /* Padding around the menu */
    border-radius: 8px; /* Rounded corners */
}

/* Menu */
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
}

.submenu {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    z-index: 1;
    max-height: 300px;
    overflow-y: auto;
}

.submenu a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
}

.submenu a:hover {
    background-color: #ddd;
}

.menu-item:hover .submenu {
    display: block;
}

.menu-item:hover {
    background-color: #416ab6;
}

/* About Us Section */
.about {
    width: 100%;
    padding: 78px 0px;
}

.about img {
    height: auto;
    width: 400px;
}

.abt-text {
    width: 500px;
}

.abt-text h1 {
    font-size: 70px;
    color: rgb(0, 0, 0);
    margin-bottom: 20px;
    letter-spacing: 1px;
}

.abt-text h1 span {
    color: #fc0050;
    letter-spacing: 1px;
}

.abt-text p {
    color: rgb(0, 0, 0);
    font-size: 24px;
    margin-bottom: 45px;
    line-height: 30px;
    letter-spacing: 1px;
}

.main {
    width: 1130px;
    max-width: 95%;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: space-around;
}

.connectbtn {
    display: inline-block;
    background-color: #fc0050;
    font-size: 18px;
    color: white;
    font-weight: bold;
    padding: 13px 30px;
    border-radius: 30px;
    transition: all 0.4s ease;
    text-decoration: none;
}

.connectbtn:hover {
    background-color: white;
    color: #fc0050;
    border: 2px solid #fc0050;
}

/* Footer */

.footer{
    margin-top: 80px;
    background-color: #333;
}

.foot{
    padding: 20px 0;
}

.footer-content{
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    
}

.footlinks h4{
    margin-top: 30px;
    font-size: 20px;
    font-weight: 600;
    color: white;
    margin-bottom: 30px;
    position: relative;
}


.footlinks h4::before{
    content: "";
    position: absolute;
    height: 2px;
    width: 70px;
    left: 0;
    bottom: -7px;
    background: white;
}

.footlinks ul li{
    margin-bottom: 15px;
}

.footlinks ul li a{
    font-size: 17px;
    color: #dddddd;
    display: block;
    transition: ease 0.30s;
}

.footlinks ul li a:hover{
    transform: translate(6px);
    color: white;
}

.social a{
    font-size: 25px;
    margin: 4px;
    height: 40px;
    width: 40px;
    color: rgb(21, 74, 74);
    background-color: white;
    display: inline-flex;
    justify-content: center;
    align-items: center;
    border-radius: 20px;
    transition: ease 0.30s;
}

.social a:hover{
    transform: scale(1.2);
}

.end{
    text-align: center;
    padding-top: 60px;
    padding-bottom: 12px;
}

.end p{
    font-size: 15px;
    color: white;
    letter-spacing: 1px;
    font-weight: 300;
}

/* About Us */

.aboutbody{
    background-color: #191919;
}

.about{
    width: 100%;
    padding: 78px 0px;
}

.about img{
    height: auto;
    width: 400px;
}

.abt-text{
    width: 500px;
}

.abt-text h1{
    font-size: 70px;
    color: rgb(0, 0, 0);
    margin-bottom: 20px;
    letter-spacing: 1px;
}

.abt-text h1 span{
    color: #fc0050;
    letter-spacing: 1px;
}

.abt-text p{
    color: rgb(0, 0, 0);
    font-size: 24px;
    margin-bottom: 45px;
    line-height: 30px;
    letter-spacing: 1px;
}

.main{
    width: 1130px;
    max-width: 95%;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: space-around;
}

.connectbtn{
    display: inline-block;
    background-color: #fc0050;
    font-size: 18px;
    color: white;
    font-weight: bold;
    padding: 13px 30px;
    border-radius: 30px;
    transition: ease 0.4s;
    border: 2px solid transparent;
    letter-spacing: 1px;
}

.connectbtn:hover{
    background-color: transparent;
    border: 2px solid #fc0050;
    transform: scale(1.1);
}

.connect-section{
    margin-top: 26px;
}


.social-icons a{
    height: 40px;
    width: 40px;
    margin: 4px;
    font-size: 30px;
    color: #101010;
    background-color: rgb(0, 53, 59);
    border-radius: 20px;
    display: inline-flex;
    justify-content: center;
    align-items: center;
    transition: ease 0.30s;
}

.social-icons a:hover{
    transform: scale(1.2);
}



.end {
    padding: 10px 0;
    font-size: 14px;
}

</style>
