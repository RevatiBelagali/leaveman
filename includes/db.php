<?php
$servername = "localhost";
$username = "leavemanager_user";
$password = "Shreyas@123";
$dbname = "leaveman";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
