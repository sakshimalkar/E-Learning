<?php
$conn = new mysqli("localhost", "root", "", "crud_operation", 3307);

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the record
    $sql = "DELETE FROM payment WHERE id=$id";
    if ($conn->query($sql)) {
        
        // Reset IDs sequentially
        $conn->query("SET @num := 0");
        $conn->query("UPDATE payment SET id = @num := (@num+1)");
        $conn->query("ALTER TABLE payment AUTO_INCREMENT = 1");

        header("Location: pview.php");
    }
}
?>
