<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Home - ShareRide</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        max-width: 600px;
        margin: 50px auto;
        text-align: center;
    }

    .welcome-box {
        background: #d4edda;
        border: 1px solid #c3e6cb;
        padding: 20px;
        border-radius: 5px;
    }

    .logout-btn {
        padding: 10px 20px;
        background: #dc3545;
        color: white;
        border: none;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        margin-top: 20px;
    }
    </style>
</head>

<body>
    <div class="welcome-box">
        <h1>Well logged in!</h1>
        <p>Welcome, <?php echo htmlspecialchars($_SESSION['user_firstname']); ?>!</p>
        <p>Email: <?php echo htmlspecialchars($_SESSION['user_email']); ?></p>
    </div>

    <a href="logout.php" class="logout-btn">Logout</a>
</body>

</html>