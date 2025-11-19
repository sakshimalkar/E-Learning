<?php
session_start();

$data = json_decode(file_get_contents('php://input'), true);
$otp = $data['otp'];

// Check if OTP matches and is not expired
if (isset($_SESSION['otp'], $_SESSION['otp_expires']) && time() < $_SESSION['otp_expires'] && $_SESSION['otp'] == $otp) {
    unset($_SESSION['otp']); // Clear OTP after successful verification
    unset($_SESSION['otp_expires']);
    echo json_encode(['success' => true, 'message' => 'OTP verified successfully']);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid or expired OTP']);
}
?>
