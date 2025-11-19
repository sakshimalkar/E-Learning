<?php
include 'dotconfig.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Ensure ID is an integer

    // Delete the record
    $sql = "DELETE FROM dotpayment WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        // Reset ID sequence
        $conn->query("SET @count = 0");
        $conn->query("UPDATE dotpayment SET id = @count:= @count + 1");
        $conn->query("ALTER TABLE htmlpayment AUTO_INCREMENT = 1");

        // Redirect back to hview.php without showing a message
        header("Location: dotview.php");
        exit;
    }
}
$conn->close();
?>
