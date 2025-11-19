<?php
include 'phpconfig.php';

if (!isset($_GET['studentName'])) {
    echo json_encode(["status" => "error", "message" => "Missing student name"]);
    exit;
}

$studentName = $conn->real_escape_string($_GET['studentName']);

$sql = "SELECT status FROM phppayment WHERE student_name = '$studentName' ORDER BY action DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode(["status" => $row["status"]]); // Returns "Paid" or "Pending"
} else {
    echo json_encode(["status" => "Not Found"]);
}

$conn->close();
?>
