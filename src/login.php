<?php
session_start();
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    try {
        // Get MongoDB connection
        $db = getMongoConnection();
        $collection = $db->users;
        
        // Find user by email
        $user = $collection->findOne(['user_email' => $email]);
        
        if ($user && password_verify($password, $user['user_password'])) {
            // Login successful
            $_SESSION['user_id'] = (string)$user['_id'];
            $_SESSION['user_firstname'] = $user['user_firstname'];
            $_SESSION['user_email'] = $user['user_email'];
            
            header('Location: home.php');
            exit();
        } else {
            $error = "Invalid email or password!";
        }
    } catch (Exception $e) {
        $error = "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        max-width: 400px;
        margin: 50px auto;
    }

    input {
        width: 100%;
        padding: 8px;
        margin: 5px 0;
    }

    button {
        width: 100%;
        padding: 10px;
        background: #28a745;
        color: white;
        border: none;
        cursor: pointer;
    }

    .error {
        color: red;
    }

    .success {
        color: green;
    }
    </style>
</head>

<body>
    <h2>Login Form</h2>

    <?php if (isset($_GET['registered'])): ?>
    <p class="success">Registration successful! Please login.</p>
    <?php endif; ?>

    <?php if (isset($error)): ?>
    <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Password:</label>
        <input type="password" name="password" required>

        <button type="submit">Login</button>
    </form>

    <p>Don't have an account? <a href="registration.php">Register here</a></p>
</body>

</html>