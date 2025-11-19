<?php
session_start(); // Start the session
require_once 'config.php'; // Database connection

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get input values and trim spaces
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $contact = trim($_POST['contact'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // Validate input fields
    if (empty($name) || empty($email) || empty($contact) || empty($password)) {
        die("All fields are required.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    if (!preg_match('/^\d{10}$/', $contact)) {
        die("Invalid contact number. It should be 10 digits.");
    }

    // Check if email already exists
    $checkSql = "SELECT id FROM student WHERE Email_id = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param('s', $email);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    if ($result->num_rows > 0) {
        die("User already registered.");
    }
    $checkStmt->close();

    // Insert into the database
    $sql = "INSERT INTO student (Name, Email_id, Contact, Password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssss', $name, $email, $contact, $password); // No hashing since you prefer plaintext passwords

    if ($stmt->execute()) {
        // Store user info in session
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;

        // Redirect directly to greatprofile.php
        header("Location: greatprofile.php");
        exit;
    } else {
        die("Error inserting data: " . $stmt->error);
    }

    $stmt->close();
}

$conn->close();
?>
