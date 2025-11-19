<?php
$servername = "localhost"; // or your server address
$username = "root";        // your database username
$password = "";            // your database password
$dbname = "crud_operation"; // the name of your database
$port = 3307;              // your MySQL port (3307 in your case)

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
