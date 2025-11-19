<?php
require_once 'lconfig.php'; // Include the database configuration

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Sanitize the ID

    // Step 1: Delete the record
    $deleteQuery = "DELETE FROM loginstu WHERE id = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        // Step 2: Reorder the IDs
        $reorderQuery = "SET @new_id = 0; UPDATE loginstu SET id = (@new_id := @new_id + 1)";
        if ($conn->multi_query($reorderQuery)) {
            // Wait for the queries to complete
            while ($conn->next_result()) {;}

            // Step 3: Reset AUTO_INCREMENT
            $resetQuery = "ALTER TABLE loginstu AUTO_INCREMENT = 1";
            if ($conn->query($resetQuery)) {
                echo "Record deleted and IDs reordered successfully.";
                header("Location: lview.php"); // Redirect back to the view page
                exit;
            } else {
                echo "Error resetting AUTO_INCREMENT: " . $conn->error;
            }
        } else {
            echo "Error reordering IDs: " . $conn->error;
        }
    } else {
        echo "Error deleting record: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}

$conn->close();
?>
