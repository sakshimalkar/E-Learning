<?php
include 'rconfig.php';

$sql = "SELECT * FROM ratingstar ORDER BY submitted_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Ratings</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #FFFACD;
            padding: 30px;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
        }
        table {
            width: 90%;
            margin: auto;
            border-collapse: collapse;
            background-color: #f9f9f9;
            box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px 15px;
            text-align: center;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f1f1f1;
        }
        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            font-size: 18px;
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<h1>All Submitted Ratings</h1>

<table>
    <tr>
        <th>ID</th>
        <th>Student Name</th>
        <th>Email</th>
        <th>Rating</th>
        <th>Submitted At</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>".$row['id']."</td>
                    <td>".$row['student_name']."</td>
                    <td>".$row['email']."</td>
                    <td>".$row['rating']."</td>
                    <td>".$row['submitted_at']."</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No ratings found.</td></tr>";
    }
    ?>
</table>

<a href="homepage.html">Go to Homepage</a>

</body>
</html>
