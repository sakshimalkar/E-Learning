<?php
$servername = "localhost";      // The database server, "localhost" is correct for local development
$username = "root";             // Default username for MySQL on local environments
$password = "";                 // Default password for MySQL on local environments (empty string)
$dbname = "crud_operation";     // The name of the database you're connecting to
$port = 3307;                   // Add the correct port

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
