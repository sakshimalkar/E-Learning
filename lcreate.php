<?php
require_once 'lconfig.php'; // Include database connection

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start(); // Start the session

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Retrieve and sanitize input data
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    if (!empty($username) && !empty($password)) {
        // SQL query to insert user data
        $sql = "INSERT INTO loginstu (Username, Password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            // Bind parameters and execute the query
            $stmt->bind_param('ss', $username, $password);
            if ($stmt->execute()) {
                // Store user info in session
                $_SESSION['username'] = $username;

                // Pass user data to localStorage and redirect
                echo "<script>
                    localStorage.setItem('username', '" . addslashes($username) . "');
                    window.location.href = 'greatprofile.html';
                </script>";
                exit();
            } else {
                die("Error inserting data: " . $stmt->error);
            }

            $stmt->close();
        } else {
            die("Error preparing statement: " . $conn->error);
        }
    } else {
        echo "<script>alert('Please fill in all fields.'); window.location.href = 'login.html';</script>";
        exit();
    }
}

// Close the database connection
$conn->close();
?>
