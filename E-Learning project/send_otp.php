<?php
session_start();

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Load Composer's autoloader
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Get the email from the request
$data = json_decode(file_get_contents('php://input'), true);
$email = $data['email'] ?? '';

// Validate email
if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Invalid email address']);
    exit;
}

// Rate-limiting: Allow 1 OTP request every 60 seconds
if (isset($_SESSION['otp_last_sent']) && (time() - $_SESSION['otp_last_sent']) < 60) {
    echo json_encode(['success' => false, 'message' => 'You can request OTP only once every 60 seconds']);
    exit;
}

// Generate a random 6-digit OTP
$otp = random_int(100000, 999999);

// Save OTP and email in session with expiry time
$_SESSION['otp'] = $otp;
$_SESSION['otp_email'] = $email;
$_SESSION['otp_expires'] = time() + 300; // OTP valid for 5 minutes
$_SESSION['otp_last_sent'] = time(); // Record the time OTP was sent

// Create a new PHPMailer instance
$mail = new PHPMailer(true);

try {
    // SMTP configuration for Gmail
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'ankita.1172004@gmail.com'; // Replace with your Gmail address
    $mail->Password = 'your_app_password'; // Replace with your Gmail App Password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Debugging output
    $mail->SMTPDebug = 2; // Enable debugging for troubleshooting
    $mail->Debugoutput = 'html'; // Output in HTML format for better readability

    // Email content
    $mail->setFrom('ankita.1172004@gmail.com', 'Your App Name'); // Replace with your Gmail address
    $mail->addAddress($email);
    $mail->Subject = 'Your OTP Code';
    $mail->Body = "Your OTP code is: $otp\n\nThis OTP is valid for 5 minutes only.";

    // Send the email
    if ($mail->send()) {
        echo json_encode(['success' => true, 'message' => 'OTP sent to ' . $email]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to send OTP']);
    }
} catch (Exception $e) {
    // Handle PHPMailer exceptions
    echo json_encode(['success' => false, 'message' => 'Mailer Error: ' . $mail->ErrorInfo]);
}
