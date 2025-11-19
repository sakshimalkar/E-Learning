<?php
require 'econfig.php';  // Include the database connection

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['name']) && isset($_POST['course']) && isset($_POST['start_date'])) {
        // Retrieve form data
        $name = $_POST['name'];
        $course = $_POST['course'];
        $start_date = $_POST['start_date'];

        // Insert the data into the 'enroll' table
        $sql = "INSERT INTO enroll (name, course, start_date) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $name, $course, $start_date);

        if ($stmt->execute()) {
            // Successful insertion
            echo "Enrollment successfully created!";
            header("Location: coursetable.html");  // Redirect to another page
            exit;
        } else {
            // Display the error
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error: Missing form data.";
    }
}

// Close the database connection
$conn->close();
?>
