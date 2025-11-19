<?php
require_once 'lconfig.php'; // Include database connection

// Initialize variables
$message = "";

// Get the ID from the URL
$id = $_GET['id'] ?? null;

if (!$id) {
    $message = "Invalid ID.";
} else {
    // Fetch the record from the database
    $sql = "SELECT username, password FROM loginstu WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Error in prepare (fetch): " . $conn->error);
    }

    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        $message = "Record not found.";
    } else {
        $record = $result->fetch_assoc();
    }

    $stmt->close();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!empty($username) && !empty($password)) {
        // Update query
        $updateSql = "UPDATE loginstu SET username = ?, password = ? WHERE id = ?";
        $updateStmt = $conn->prepare($updateSql);

        if (!$updateStmt) {
            die("Error in prepare (update): " . $conn->error);
        }

        $updateStmt->bind_param('ssi', $username, $password, $id);

        if ($updateStmt->execute()) {
            if ($updateStmt->affected_rows > 0) {
                $message = "Update successful.";
            } else {
                $message = "No changes were made. Please modify the data before updating.";
            }
        } else {
            $message = "Error in update query: " . $updateStmt->error;
        }

        $updateStmt->close();
    } else {
        $message = "All fields are required.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Login</title>
</head>
<body>
    <h2>Edit Login</h2>
    <form method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?= htmlspecialchars($record['username'] ?? '') ?>" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" value="<?= htmlspecialchars($record['password'] ?? '') ?>" required><br><br>

        <button type="submit">Update</button>
    </form>

    <!-- Display the message beneath the form -->
    <?php if (!empty($message)): ?>
        <p><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>
</body>
</html>
