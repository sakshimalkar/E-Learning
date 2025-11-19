<?php
include 'phpconfig.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['studentName']) || !isset($_POST['amount'])) {
        echo "Missing required fields!";
        exit;
    }

    $studentName = $conn->real_escape_string($_POST['studentName']);
    $amount = $conn->real_escape_string($_POST['amount']);
    $status = "Paid";  
    $action = date("Y-m-d H:i:s"); 

    $sql = "INSERT INTO phppayment (student_name, status, action, amount) 
            VALUES ('$studentName', '$status', '$action', '$amount')";

    if ($conn->query($sql) === TRUE) {
        echo "Payment record added successfully";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
