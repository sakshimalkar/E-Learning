<?php
include 'rconfig.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    $sql = "DELETE FROM ratingstar WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Rating deleted successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
