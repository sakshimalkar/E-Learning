<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "crud_operation", 3307);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch records from the database
$sql = "SELECT * FROM phppayment";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Records</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Payment Records</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Student Name</th>
                    <th>Status</th>
                    <th>Action Time</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row["id"]; ?></td>
                        <td><?php echo $row["student_name"]; ?></td>
                        <td><?php echo $row["status"]; ?></td>
                        <td><?php echo $row["action"]; ?></td>
                        <td>
                            <a href="phpupdate.php?id=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">Edit</a>
                            <a href="phpdelete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?');">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>
