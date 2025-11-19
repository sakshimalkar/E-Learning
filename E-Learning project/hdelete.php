<?php
include 'hconfig.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Ensure ID is an integer

    // Delete the record
    $sql = "DELETE FROM htmlpayment WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        // Reset ID sequence
        $conn->query("SET @count = 0");
        $conn->query("UPDATE htmlpayment SET id = @count:= @count + 1");
        $conn->query("ALTER TABLE htmlpayment AUTO_INCREMENT = 1");

        // Redirect back to hview.php without showing a message
        header("Location: hview.php");
        exit;
    }
}
$conn->close();
?>
