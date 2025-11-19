<?php
include "cconfig.php"; // Include the database connection

if (isset($_GET['id'])) {
    $idToDelete = $_GET['id'];

    // Delete the selected record
    $deleteQuery = "DELETE FROM course WHERE id = $idToDelete";

    if ($conn->query($deleteQuery) === TRUE) {
        // Reorder the IDs to maintain sequential order
        $resetQuery = "SET @new_id = 0;
                       UPDATE course SET id = (@new_id := @new_id + 1) ORDER BY id;
                       ALTER TABLE course AUTO_INCREMENT = 1;";

        if ($conn->multi_query($resetQuery)) {
            do {
                // Process each query in the multi-query statement
            } while ($conn->next_result());
        }

        // Redirect back to the view page after deletion
        header("Location: cview.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}
?>
