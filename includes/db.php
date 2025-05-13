<?php
$servername = "localhost";
$username = "leavemanager_user"; // the username you created
$password = "shreyas";           // the password you set for the user
$dbname = "leavemanager";        // the name of the database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Database connected successfully!";
?>
