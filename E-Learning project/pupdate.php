<?php
$conn = new mysqli("localhost", "root", "", "crud_operation", 3307);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$payment_id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$message = "";
$row = ['student_name' => '', 'status' => 'Pending', 'action' => date('Y-m-d H:i:s')]; // Default values

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $payment_id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
    $student_name = isset($_POST['student_name']) ? $conn->real_escape_string($_POST['student_name']) : '';
    $status = isset($_POST['status']) ? $conn->real_escape_string($_POST['status']) : '';
    $action_date = isset($_POST['action']) ? $conn->real_escape_string($_POST['action']) : date('Y-m-d H:i:s'); // Get date or set current timestamp

    if ($payment_id > 0 && !empty($student_name) && !empty($status)) {
        $sql = "UPDATE payment SET student_name = '$student_name', status = '$status', action = '$action_date' WHERE id = $payment_id";
        if ($conn->query($sql)) {
            $message = "Payment record updated successfully!";
        } else {
            $message = "Error updating payment: " . $conn->error;
        }
    } else {
        $message = "Invalid input.";
    }
}

// Fetch payment details
if ($payment_id > 0) {
    $sql = "SELECT * FROM payment WHERE id = $payment_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        $message = "Payment record not found.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Payment</title>
</head>
<body>
    <h2>Edit Payment</h2>

    <?php if ($message) echo "<p>$message</p>"; ?>

    <form method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($payment_id); ?>">

        <label for="student_name">Student Name:</label>
        <input type="text" name="student_name" id="student_name" value="<?php echo htmlspecialchars($row['student_name'] ?? ''); ?>" required><br><br>

        <label for="status">Status:</label>
        <select name="status" id="status">
            <option value="Pending" <?php echo (isset($row['status']) && $row['status'] == 'Pending') ? 'selected' : ''; ?>>Pending</option>
            <option value="Paid" <?php echo (isset($row['status']) && $row['status'] == 'Paid') ? 'selected' : ''; ?>>Paid</option>
        </select><br><br>

        <label for="action">Date:</label>
        <input type="datetime-local" name="action" id="action" value="<?php echo isset($row['action']) ? date('Y-m-d\TH:i', strtotime($row['action'])) : date('Y-m-d\TH:i'); ?>" required><br><br>

        <button type="submit">Update Payment</button>
    </form>

    <br>
    <a href="index.php">Back to Home</a>
</body>
</html>
