<?php
$servername = "localhost";
$username = "leavemanager_user";
$password = "shreyas";  // Make sure this matches the password in the SQL file
$dbname = "leavemanager";  // Use the correct database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");
?>