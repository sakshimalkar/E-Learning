<?php
include 'xconfig.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $course_name = $_POST['course_name'];
    $fee = $_POST['fee'];
    $date = $_POST['date'];
    $score = $_POST['score'];

    $sql = "UPDATE exam SET username='$username', course_name='$course_name', fee='$fee', date='$date', score='$score' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Exam updated successfully";
    } else {
        echo "Error updating exam: " . $conn->error;
    }
}

$id = $_GET['id'];
$sql = "SELECT * FROM exam WHERE id='$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<form method="post">
    <input type="hidden" name="id" value="<?= $row['id'] ?>">
    User Name: <input type="text" name="username" value="<?= $row['username'] ?>" required><br>
    Course Name: <input type="text" name="course_name" value="<?= $row['course_name'] ?>" required><br>
    Fee: <input type="text" name="fee" value="<?= $row['fee'] ?>" required><br>
    Date: <input type="date" name="date" value="<?= $row['date'] ?>" required><br>
    Score: <input type="text" name="score" value="<?= $row['score'] ?>"><br>
    <input type="submit" value="Update Exam">
</form>