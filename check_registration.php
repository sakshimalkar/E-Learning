<?php
require_once 'config.php'; // Include database connection file

header('Content-Type: application/json');

// Enable error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Read JSON data from the POST request
$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    echo json_encode(['success' => false, 'message' => 'No data received.']);
    exit;
}

$name = $data['name'] ?? '';
$email = $data['email'] ?? '';
$contact = $data['contact'] ?? '';
$password = $data['password'] ?? '';

// Validate required fields
if (empty($name) || empty($email) || empty($contact) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'Please fill in all fields.']);
    exit;
}

// Check if the email is already registered
$sql = "SELECT * FROM student WHERE Email_id = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode(['success' => false, 'message' => 'Database query preparation failed.']);
    exit;
}

$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // User already exists
    echo json_encode(['success' => false, 'message' => 'Email is already registered.']);
} else {
    // Insert new user if not registered
    $sql = "INSERT INTO student (Name, Email_id, Contact, Password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        echo json_encode(['success' => false, 'message' => 'Failed to prepare insert query.']);
        exit;
    }

    $stmt->bind_param('ssss', $name, $email, $contact, $password);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]); // Registration successful
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to register. Please try again.']);
    }
}

$stmt->close();
$conn->close();
?>
