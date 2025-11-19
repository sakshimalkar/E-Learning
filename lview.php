<?php
require_once 'lconfig.php'; // Include the database connection

// Fetch data from the `loginstu` table
$sql = "SELECT * FROM loginstu";
$result = $conn->query($sql);

if ($result === false) {
    die("Error executing query: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Users</h2>
              <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Password</th>
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
                            <td><?php echo htmlspecialchars($row['Username']); ?></td>
                            <td><?php echo htmlspecialchars($row['Password']); ?></td>
                            <td>
                                <a class="btn btn-info" href="lupdate.php?id=<?php echo urlencode($row['id']); ?>">Edit</a>
                                <a class="btn btn-danger" href="ldelete.php?id=<?php echo urlencode($row['id']); ?>" 
                                 

<a class="btn btn-danger" href="ldelete.php?id=<?php echo urlencode($row['id']); ?>"
   onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>




                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='4' class='text-center'>No records found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
