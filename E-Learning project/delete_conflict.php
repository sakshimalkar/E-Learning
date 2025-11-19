<?php
require_once 'config.php';

// SQL query to delete rows with id = 0
$query = "DELETE FROM student WHERE id = 0";

if ($conn->query($query) === TRUE) {
    echo "Conflicting rows deleted successfully.";
} else {
    echo "Error: " . $conn->error;
}

// Close the connection
$conn->close();
?>
