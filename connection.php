<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$db = "db_users";

// Attempt to establish connection
$conn = mysqli_connect($servername, $username, $password, $db);

// Check connection
if (!$conn) {
    // If connection fails, print error message and terminate script
    die("Connection failed: " . mysqli_connect_error());
}
?>
