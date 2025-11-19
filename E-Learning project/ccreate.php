<?php
include "cconfig.php"; // Include the database connection

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data and prevent SQL injection
    $course_name = $conn->real_escape_string($_POST['courses']); 
    $duration = $conn->real_escape_string($_POST['duration']);
    $amount = (int) $_POST['amount']; // Ensure amount is stored as an integer

    // Insert the data into the database
    $sql = "INSERT INTO course (course_name, duration, amount) VALUES ('$course_name', '$duration', '$amount')";

    if ($conn->query($sql) === TRUE) {
        // Redirect based on selected course
        switch ($course_name) {
            case 'java':
                header("Location: restrict.html");
                break;
            case 'html':
                header("Location: restrict1.html");
                break;
            case 'php':
                header("Location: restrict2.html");
                break;
            case 'dotnet':
                header("Location: restrict3.html");
                break;
            default:
                header("Location: defaultPage.php");
        }
        exit();
    } else {
        echo "Error: " . $conn->error; // Show error message if insertion fails
    }
}
?>
