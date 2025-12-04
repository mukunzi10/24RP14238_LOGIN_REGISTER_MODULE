<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    try {
        // Get MongoDB connection
        $db = getMongoConnection();
        $collection = $db->users;
        
        // Check if email already exists
        $existingUser = $collection->findOne(['user_email' => $email]);
        
        if ($existingUser) {
            $error = "Email already registered!";
        } else {
            // Insert new user
            $result = $collection->insertOne([
                'user_firstname' => $firstname,
                'user_lastname' => $lastname,
                'user_gender' => $gender,
                'user_email' => $email,
                'user_password' => $password,
                'created_at' => new MongoDB\BSON\UTCDateTime()
            ]);
            
            if ($result->getInsertedCount() > 0) {
                header('Location: login.php?registered=success');
                exit();
            } else {
                $error = "Registration failed!";
            }
        }
    } catch (Exception $e) {
        $error = "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Registration</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        max-width: 400px;
        margin: 50px auto;
    }

    input,
    select {
        width: 100%;
        padding: 8px;
        margin: 5px 0;
    }

    button {
        width: 100%;
        padding: 10px;
        background: #007bff;
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
    <h2>Registration Form</h2>

    <?php if (isset($error)): ?>
    <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label>First Name:</label>
        <input type="text" name="firstname" required>

        <label>Last Name:</label>
        <input type="text" name="lastname" required>

        <label>Gender:</label>
        <select name="gender" required>
            <option value="">Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select>

        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Password:</label>
        <input type="password" name="password" required>

        <button type="submit">Register</button>
    </form>

    <p>Already have an account? <a href="login.php">Login here</a></p>
</body>

</html>