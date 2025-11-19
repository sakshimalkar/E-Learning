<?php
require 'econfig.php';

$id = $_GET['id'] ?? null;

if ($id) {
    // Fetch current record
    $sql = "SELECT * FROM enroll WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $record = $result->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $course = $_POST['course'];
        $start_date = $_POST['start_date'];

        // Update record
        $sql = "UPDATE enroll SET name = ?, course = ?, start_date = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $name, $course, $start_date, $id);

        if ($stmt->execute()) {
            header("Location: eview.php");
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }
    }
} else {
    header("Location: eview.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Enrollment</title>
</head>
<body>
    <h1>Edit Enrollment</h1>
    <form method="POST">
        <label>Name:</label>
        <input type="text" name="name" value="<?= $record['name'] ?>" required><br>
        <label>Course:</label>
        <input type="text" name="course" value="<?= $record['course'] ?>" required><br>
        <label>Start Date:</label>
        <input type="date" name="start_date" value="<?= $record['start_date'] ?>" required><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>
