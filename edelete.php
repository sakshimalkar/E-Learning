<?php
require 'econfig.php';  // Include database connection

// Get the ID to delete from the GET request
$id = $_GET['id'] ?? null;

if ($id) {
    // Step 1: Delete the record with the specified ID
    $sql = "DELETE FROM enroll WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Step 2: Reassign IDs to maintain sequential order
        $reset_id_sql = "
            SET @new_id = 0;
            UPDATE enroll SET id = (@new_id := @new_id + 1) ORDER BY id;
            ALTER TABLE enroll AUTO_INCREMENT = 1;
        ";

        // Execute the ID reassignment and reset AUTO_INCREMENT
        if ($conn->multi_query($reset_id_sql)) {
            do {
                $conn->next_result(); // Move to the next result if available
            } while ($conn->more_results());
        }

        // Redirect to the view page after successful deletion
        header("Location: eview.php");
        exit;
    } else {
        // Display an error if the delete operation fails
        echo "Error: " . $stmt->error;
    }

    // Close the prepared statement
    $stmt->close();
} else {
    // Redirect to the view page if no ID is provided
    header("Location: eview.php");
    exit;
}

// Close the database connection
$conn->close();
?>
