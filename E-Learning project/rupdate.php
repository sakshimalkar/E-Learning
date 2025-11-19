<?php
include 'rconfig.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $rating = $_POST['rating'];

    $sql = "UPDATE ratingstar SET rating='$rating' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Rating updated successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
