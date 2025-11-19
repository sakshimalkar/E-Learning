<?php
include 'hconfig.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if required fields exist
    if (!isset($_POST['studentName']) || !isset($_POST['amount'])) {
        echo "Missing required fields!";
        exit;
    }

    // Get form values and escape them
    $studentName = $conn->real_escape_string($_POST['studentName']);
    $amount = $conn->real_escape_string($_POST['amount']);
    $status = "Paid";  // Default status
    $action = date("Y-m-d H:i:s"); // Store the current timestamp

    // Correct column names based on your table
    $sql = "INSERT INTO htmlpayment (student_name, status, action, amount) 
            VALUES ('$studentName', '$status', '$action', '$amount')";

    if ($conn->query($sql) === TRUE) {
        echo "Payment record added successfully";
    } else {
        echo "Error: " . $conn->error;  // Debugging error
    }
}

$conn->close();
?>
