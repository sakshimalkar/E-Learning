<?php
require_once 'lconfig.php'; // Include the database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize the user input
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    if (!empty($username) && !empty($password)) {
        // Prepare the SQL query to fetch the stored hashed password from the loginstu table
        $sql = "SELECT password FROM loginstu WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $username); // Bind the username parameter
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($stored_hashed_password);

        if ($stmt->fetch()) {
            // Verify the entered password with the stored hash
            if (password_verify($password, $stored_hashed_password)) {
                echo "Login successful!";
                // Redirect to a protected page (dashboard.php or any other page)
                header("Location: dashboard.php");
                exit();
            } else {
                echo "Invalid username or password.";
            }
        } else {
            echo "No user found with that username.";
        }
    } else {
        echo "Please fill in all fields.";
    }
}
?>
