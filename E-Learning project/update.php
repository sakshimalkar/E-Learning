<?php
require_once 'config.php'; // Include database connection

// Get the ID from the URL
$id = $_GET['id'] ?? null;

if (!$id) {
    echo "Invalid ID.";
    exit;
}

// Fetch the record from the database
$sql = "SELECT * FROM student WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Record not found.";
    exit;
}

$record = $result->fetch_assoc();
$stmt->close();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $contact = $_POST['contact'] ?? '';
    $password = $_POST['password'] ?? '';

    $updateSql = "UPDATE student SET Name = ?, Email_id = ?, Contact = ?, Password = ? WHERE id = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param('ssssi', $name, $email, $contact, $password, $id);

    if ($updateStmt->execute()) {
        header("Location: view.php"); // Redirect to the view page
        exit;
    } else {
        echo "Error: " . $updateStmt->error;
    }

    $updateStmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Registration</title>
</head>
<body>
    <h1>Update Registration</h1>
    <form method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($record['Name'] ?? '') ?>" required><br><br>

        <label for="email">Email-id:</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($record['Email_id'] ?? '') ?>" required><br><br>

        <label for="contact">Contact:</label>
        <input type="text" id="contact" name="contact" value="<?= htmlspecialchars($record['Contact'] ?? '') ?>" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" value="<?= htmlspecialchars($record['Password'] ?? '') ?>" required><br><br>

        <button type="submit">Update</button>
    </form>
</body>
</html>
