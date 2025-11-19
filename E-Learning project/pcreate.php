<?php
$conn = new mysqli("localhost", "root", "", "crud_operation", 3307);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["student_name"])) {
    $student_name = $conn->real_escape_string($_POST["student_name"]);

    // Insert payment record with status 'Pending'
    $sql = "INSERT INTO payment (student_name, status, action) VALUES ('$student_name', 'Paid', NOW())";

    if ($conn->query($sql)) {
        // Get the ID of the newly inserted payment record
        $inserted_id = $conn->insert_id;
        echo $inserted_id;  // Return the inserted ID
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
