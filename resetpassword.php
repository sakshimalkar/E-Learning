<?php
$data = json_decode(file_get_contents('php://input'), true);
$newPassword = $data['password'];

// Hash the new password (use this in real applications)
$hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

// Simulate saving to the database (you need to implement this with your database)
if ($hashedPassword) {
    echo json_encode(['success' => true, 'message' => 'Password reset successfully']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to reset password']);
}
?>
