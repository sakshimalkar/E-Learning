<?php
require_once 'config.php'; // Include database connection file

header('Content-Type: application/json');

// Read JSON data from the POST request
$data = json_decode(file_get_contents('php://input'), true);

$name = $data['name'] ?? '';
$email = $data['email'] ?? '';
$contact = $data['contact'] ?? '';
$password = $data['password'] ?? '';

// Validate required fields
if (empty($name) || empty($email) || empty($contact) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'Please fill in all fields.']);
    exit;
}

// Check if the email and name are already registered
$sql = "SELECT * FROM student WHERE Email_id = ? AND Name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $email, $name);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // User already exists, check if the password matches
    $user = $result->fetch_assoc();
    if ($user['Password'] === $password) {
        echo json_encode(['success' => true]); // Password matches, allow registration
    } else {
        echo json_encode(['success' => false, 'message' => 'Email and name already registered. Incorrect password.']);
    }
} else {
    // Insert new user if not registered
    $sql = "INSERT INTO student (Name, Email_id, Contact, Password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
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
