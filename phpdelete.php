<?php
include 'phpconfig.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Ensure ID is an integer

    // Delete the record
    $sql = "DELETE FROM phppayment WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        // Reset ID sequence
        $conn->query("SET @count = 0");
        $conn->query("UPDATE phppayment SET id = @count:= @count + 1");
        $conn->query("ALTER TABLE htmlpayment AUTO_INCREMENT = 1");
        
        echo "Record deleted and IDs reset successfully.";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "Invalid ID!";
}

$conn->close();
?>
