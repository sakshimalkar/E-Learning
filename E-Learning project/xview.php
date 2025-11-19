<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "crud_operation", 3307);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch unique courses for dropdown
$courseQuery = "SELECT DISTINCT course_name FROM exam";
$courseResult = $conn->query($courseQuery);

// Get selected course (from dropdown)
$selectedCourse = isset($_POST['course_name']) ? $_POST['course_name'] : "";

// Fetch records based on selection
$sql = "SELECT * FROM exam";
if (!empty($selectedCourse)) {
    $sql .= " WHERE course_name = '$selectedCourse'";
}
$result = $conn->query($sql);

// Calculate total fee and average score
$totalFee = 0;
$totalScore = 0;
$count = 0;
while ($row = $result->fetch_assoc()) {
    $totalFee += $row["fee"];
    $totalScore += $row["score"];
    $count++;
}
$averageScore = $count > 0 ? round($totalScore / $count, 2) : 0;

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Records</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Exam Records</h2>

        <!-- Course Filter Form -->
        <form method="POST">
            <label for="courseFilter">Select Course:</label>
            <select id="courseFilter" name="course_name" class="form-control" style="width: 300px;" onchange="this.form.submit()">
                <option value="">All Courses</option>
                <?php 
                $courseResult->data_seek(0); // Reset pointer to reuse result
                while ($row = $courseResult->fetch_assoc()) { 
                    $selected = ($row["course_name"] == $selectedCourse) ? "selected" : "";
                    echo "<option value='{$row["course_name"]}' $selected>{$row["course_name"]}</option>";
                }
                ?>
            </select>
        </form>

        <!-- Table -->
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Student Name</th>
                    <th>Course Name</th>
                    <th>Fee (Rs.)</th>
                    <th>Exam Date</th>
                    <th>Score</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $result->data_seek(0); // Reset pointer to reuse result
                while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row["id"]; ?></td>
                        <td><?php echo $row["username"]; ?></td>
                        <td><?php echo $row["course_name"]; ?></td>
                        <td><?php echo $row["fee"]; ?></td>
                        <td><?php echo $row["date"]; ?></td>
                        <td><?php echo $row["score"]; ?></td>
                        <td>
                            <a href="xupdate.php?id=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">Edit</a>
                            <a href="xdelete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?');">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <!-- Total Fee and Average Score -->
        <div class="mt-3">
            <h5>Total Fee: Rs. <span><?php echo $totalFee; ?></span></h5>
            <h5>Average Score: <span><?php echo $averageScore; ?></span></h5>
        </div>
    </div>
</body>
</html>
