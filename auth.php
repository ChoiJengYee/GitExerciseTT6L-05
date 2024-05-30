<?php
ob_start(); // Start output buffering
$conn = mysqli_connect('localhost', 'root', '', 'user_db') or die('Connection failed');
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}
ob_end_flush(); // Flush output buffer
?>

