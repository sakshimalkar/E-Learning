<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

include 'xconfig.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $course_name = $_POST['course_name'];
    $fee = $_POST['fee'];
    $date = $_POST['date'];
    $score = $_POST['score'];

    // Prepared statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO exam (username, course_name, fee, date, score) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdsi", $username, $course_name, $fee, $date, $score);

    if ($stmt->execute()) {
        echo "Data inserted successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close connections
    $stmt->close();
    $conn->close();
}
?>
