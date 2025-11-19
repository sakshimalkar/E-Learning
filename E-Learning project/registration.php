<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #FFEFD5;
        }
        .container {
            width: 500px;
            padding: 100px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .tabs {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px;
        }
        .tabs div {
            font-weight: bold;
            cursor: pointer;
            padding: 10px;
            border-bottom: 2px solid transparent;
        }
        .tabs .active {
            color: #007bff;
            border-bottom: 2px solid #007bff;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .buttons {
            display: flex;
            justify-content: space-between;
        }
        .buttons input[type="submit"],
        .buttons input[type="button"] {
            padding: 10px 20px;
            border: none;
            background-color: #007bff;
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }
        .buttons input[type="button"] {
            background-color: #6c757d;
        }
        .buttons input[type="submit"]:hover,
        .buttons input[type="button"]:hover {
            background-color: #0056b3;
        }
        .buttons input[type="button"]:hover {
            background-color: #5a6268;
        }
    </style>

</head>
<body>
  <form action="http://localhost/elearning/create.php" method="POST">



        <div class="container">
            <div class="tabs">
                <div class="tab"><a href="1interface.html" style="text-decoration:none;">Admin</a></div>
                <div class="tab active"><a href="registration.html" style="text-decoration:none;">Student</a></div>
            </div>

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email-id</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="contact">Contact</label>
                <input type="tel" id="contact" name="contact" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="buttons">
                <input type="submit" value="Submit">
            </div>
            <div style="margin-top: 20px; text-align: center;">
                <p>Already have an account? <a href="login.html" style="text-decoration: none; color: #007bff;">Login here</a></p>
            </div>
        </div>
    </form>

    <script>
        document.querySelector('form').addEventListener('submit', function () {
            // Save the name in localStorage
            let name = document.getElementById('name').value;
            localStorage.setItem('username', name);
        });
    </script>

</body>
</html>
