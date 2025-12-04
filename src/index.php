<?php
session_start();

// Check if user is already logged in
if (isset($_SESSION['user_id'])) {
    header('Location: home.php');
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>ShareRide - Welcome</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        max-width: 600px;
        margin: 100px auto;
        text-align: center;
        background: #f4f4f4;
        padding: 20px;
    }

    .container {
        background: white;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        color: #333;
    }

    .btn {
        display: inline-block;
        padding: 15px 30px;
        margin: 10px;
        text-decoration: none;
        border-radius: 5px;
        font-size: 16px;
        transition: all 0.3s;
    }

    .btn-primary {
        background: #007bff;
        color: white;
    }

    .btn-primary:hover {
        background: #0056b3;
    }

    .btn-success {
        background: #28a745;
        color: white;
    }

    .btn-success:hover {
        background: #218838;
    }
    </style>
</head>

<body>
    <div class="container">
        <h1>Welcome to ShareRide</h1>
        <p>Your trusted ride-sharing platform</p>

        <div style="margin-top: 30px;">
            <a href="registration.php" class="btn btn-primary">Register</a>
            <a href="login.php" class="btn btn-success">Login</a>
        </div>
    </div>
</body>

</html>