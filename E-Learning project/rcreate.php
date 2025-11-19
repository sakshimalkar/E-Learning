<?php
include 'rconfig.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_name = $_POST['student_name'];
    $email = $_POST['email'];
    $rating = $_POST['rating'];

    $sql = "INSERT INTO ratingstar (student_name, email, rating) VALUES ('$student_name', '$email', '$rating')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to homepage after successful submission
        header("Location: homepage.html");
        exit();
    } else {
        echo "<script>
                alert('Error occurred while submitting your rating. Please try again.');
                window.location.href = 'homepage.html';
              </script>";
    }

    $conn->close();
}
?>
