<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "crud_operation", 3307);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if ID is set
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Ensure ID is an integer

    // Use prepared statements to prevent SQL Injection
    $stmt = $conn->prepare("DELETE FROM exam WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Reset IDs sequentially
        $conn->query("SET @num := 0");
        $conn->query("UPDATE exam SET id = @num := (@num+1) ORDER BY id");
        $conn->query("ALTER TABLE exam AUTO_INCREMENT = 1");

        // Redirect back to the exam records page
        header("Location: xview.php");
        exit(); // Ensure script stops after redirection
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
