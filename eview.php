<?php
require 'econfig.php';

$sql = "SELECT * FROM enroll";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Enrollments</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 2px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .action-buttons a {
            text-decoration: none;
            color: white;
            padding: 5px 10px;
            margin: 2px;
            border-radius: 5px;
            font-size: 20px;
        }
        .action-buttons a.edit {
            background-color: #4CAF50; /* Green */
        }
        .action-buttons a.delete {
            background-color: #f44336; /* Red */
        }
        .action-buttons a:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <h1>Enrollment Records</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Course</th>
            <th>Start Date</th>
            <th>Actions</th>
        </tr>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['course'] ?></td>
                    <td><?= $row['start_date'] ?></td>
                    <td class="action-buttons">
                        <a href="eupdate.php?id=<?= $row['id'] ?>" class="edit">Edit</a>
                        <a href="edelete.php?id=<?= $row['id'] ?>" class="delete" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="5">No records found.</td></tr>
        <?php endif; ?>
    </table>
</body>
</html>

<?php $conn->close(); ?>
