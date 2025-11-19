<?php
require_once 'config.php'; // Include database connection file

header('Content-Type: application/json');

// Read JSON data from the POST request
$data = json_decode(file_get_contents('php://input'), true);

// Extract form fields
$name = $data['name'] ?? '';
$email = $data['email'] ?? '';
$contact = $data['contact'] ?? '';
$password = $data['password'] ?? '';

// Validate required fields
if (empty($name) || empty($email) || empty($contact) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'Please fill in all fields.']);
    exit;
}

// Check if email already exists in the database
$sql = "SELECT * FROM student WHERE Email_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Email already exists
    echo json_encode(['success' => false, 'message' => 'User already registered with this email.']);
    exit;
}

// Insert new user into the database
$sql = "INSERT INTO student (Name, Email_id, Contact, Password) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ssss', $name, $email, $contact, $password);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to register. Please try again.']);
}

$stmt->close();
$conn->close();
?>
