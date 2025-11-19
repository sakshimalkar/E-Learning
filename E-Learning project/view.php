<?php
require 'config.php';

// Fetch student records
$sql = "SELECT * FROM student";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Students</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
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
            font-size: 14px;
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
    <h1>Student Records</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Actions</th>
        </tr>
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['Name']) ?></td>
                    <td><?= htmlspecialchars($row['Email_id']) ?></td>
                    <td><?= htmlspecialchars($row['Contact']) ?></td>
                    <td class="action-buttons">
                        <a href="update.php?id=<?= $row['id'] ?>" class="edit">Edit</a>
                        <a href="delete.php?id=<?= $row['id'] ?>" class="delete" onclick="return confirm('Are you sure?')">Delete</a>
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
