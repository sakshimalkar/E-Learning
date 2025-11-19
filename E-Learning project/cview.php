<?php
include "cconfig.php"; // Database connection

// Get course filter value (if applied)
$course_filter = isset($_GET['course_filter']) ? $_GET['course_filter'] : '';

// Query to fetch courses with filtering
$query = "SELECT * FROM course";
if (!empty($course_filter)) {
    $query .= " WHERE course_name = '$course_filter'";
}
$query .= " ORDER BY id";

$result = $conn->query($query);

// Query to calculate total amount
$totalQuery = "SELECT SUM(amount) AS total_amount FROM course";
if (!empty($course_filter)) {
    $totalQuery .= " WHERE course_name = '$course_filter'";
}
$totalResult = $conn->query($totalQuery);
$totalRow = $totalResult->fetch_assoc();
$totalAmount = $totalRow['total_amount'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Courses</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="text-center">Course Records</h2>

        <!-- Course Filter Form -->
        <form method="GET" action="" class="form-inline text-center">
            <label for="filter">Filter by Course:</label>
            <select name="course_filter" id="filter" class="form-control">
                <option value="">All</option>
                <option value="java" <?= $course_filter == "java" ? "selected" : "" ?>>Java</option>
                <option value="html" <?= $course_filter == "html" ? "selected" : "" ?>>HTML</option>
                <option value="php" <?= $course_filter == "php" ? "selected" : "" ?>>PHP</option>
                <option value="dotnet" <?= $course_filter == "dotnet" ? "selected" : "" ?>>DOTNET</option>
            </select>
            <button type="submit" class="btn btn-primary">Apply</button>
            <a href="all_courses.php" class="btn btn-default">Reset</a>
        </form>

        <!-- Course Table -->
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Course Name</th>
                    <th>Duration</th>
                    <th>Amount</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['course_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['duration']); ?></td>
                            <td><?php echo htmlspecialchars($row['amount']); ?></td>
                            <td>
                                <a class="btn btn-info" href="cupdate.php?id=<?php echo urlencode($row['id']); ?>">Edit</a>
                                <a class="btn btn-danger" href="cdelete.php?id=<?php echo urlencode($row['id']); ?>"
                                   onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>No records found.</td></tr>";
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-right"><strong>Total Amount:</strong></td>
                    <td><strong><?php echo number_format($totalAmount, 2); ?></strong></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</body>
</html>
