<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "crud_operation"; // Update this to your database name
$port = 3307; // Use the new port

// Create connection with the new port
$conn = new mysqli($host, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
