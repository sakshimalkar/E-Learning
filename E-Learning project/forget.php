<?php
// Ensure sessions are started if needed for OTP
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Password Reset</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f9;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .container {
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      width: 300px;
      text-align: center;
    }
    .container h2 {
      margin-bottom: 20px;
    }
    input[type="text"], input[type="password"] {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    button {
      background-color: #4CAF50;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      width: 100%;
    }
    button:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>
  <div class="container" id="email-page">
    <h2>Forgot Password</h2>
    <p>Enter your email to receive the OTP:</p>
    <input type="text" id="email" placeholder="Enter your email">
    <button onclick="sendOTP()">Send OTP</button>
  </div>

  <div class="container" id="otp-page" style="display: none;">
    <h2>Verify OTP</h2>
    <p>Enter the OTP sent to your email:</p>
    <input type="text" id="otp" placeholder="Enter OTP">
    <button onclick="verifyOTP()">Verify OTP</button>
  </div>

  <div class="container" id="reset-page" style="display: none;">
    <h2>Reset Password</h2>
    <input type="password" id="new-password" placeholder="Enter new password">
    <input type="password" id="confirm-password" placeholder="Confirm new password">
    <button onclick="resetPassword()">Reset Password</button>
  </div>

  <script>
    function sendOTP() {
      const email = document.getElementById('email').value;
      if (email) {
        fetch('send_otp.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ email })
        })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              alert('OTP sent to ' + email);
              document.getElementById('email-page').style.display = 'none';
              document.getElementById('otp-page').style.display = 'block';
            } else {
              alert(data.message || 'Failed to send OTP');
            }
          });
      } else {
        alert('Please enter your email');
      }
    }

    function verifyOTP() {
      const otp = document.getElementById('otp').value;
      fetch('verify_otp.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ otp })
      })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            alert('OTP verified successfully');
            document.getElementById('otp-page').style.display = 'none';
            document.getElementById('reset-page').style.display = 'block';
          } else {
            alert(data.message || 'Invalid OTP');
          }
        });
    }

    function resetPassword() {
      const newPassword = document.getElementById('new-password').value;
      const confirmPassword = document.getElementById('confirm-password').value;
      if (newPassword && confirmPassword && newPassword === confirmPassword) {
        fetch('reset_password.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ password: newPassword })
        })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              alert('Password reset successfully');
              location.reload();
            } else {
              alert(data.message || 'Failed to reset password');
            }
          });
      } else {
        alert('Passwords do not match');
      }
    }
  </script>
</body>
</html>
