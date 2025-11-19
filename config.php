<?php
$servername = "localhost";
$username = "root";
$password = ""; // Default for XAMPP
$dbname = "crud_operation";
$port = 3307; // Change to 3306 if necessary

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>
