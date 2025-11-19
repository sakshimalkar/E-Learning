

<?php
$servername = "localhost";
$username = "root";
$password = ""; // If there's no password, leave it empty
$dbname = "crud_operation";
$port = 3307; // Specify the new port

$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>

