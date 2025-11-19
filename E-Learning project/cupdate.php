<?php
include "cconfig.php";

$id = $_GET['id'];
$sql = "SELECT * FROM course WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course_name = $_POST['course_name'];
    $duration = $_POST['duration'];
    $amount = $_POST['amount'];

    $update_sql = "UPDATE course SET course_name='$course_name', duration='$duration', amount='$amount' WHERE id=$id";

    if ($conn->query($update_sql) === TRUE) {
        echo "Course updated successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<form method="post">
    <label>Course Name:</label>
    <input type="text" name="course_name" value="<?php echo $row['course_name']; ?>" required><br>
    
    <label>Duration:</label>
    <input type="text" name="duration" value="<?php echo $row['duration']; ?>" required><br>
    
    <label>Amount:</label>
    <input type="number" name="amount" value="<?php echo $row['amount']; ?>" required><br>
    
    <button type="submit">Update Course</button>
</form>
