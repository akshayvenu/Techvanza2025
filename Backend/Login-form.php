<?php

session_start();

ini_set('display_errors','Off');

// Check if the user is logged in
if (isset($_SESSION['email'])) {
    header('Location: index.php'); // Redirect to login page if not logged in
    exit;
}

// Welcome message
$role = $_SESSION['role'];
$name = $_SESSION['name'];

// Include the logic file to handle the login logic
include './php/Login-form.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="./style/authentication.css" rel="stylesheet">
</head>
<body>

    <div class="navbar">
        <span class="title">आशाएं</span>
        <span class="tagline">" नवीन दिशा, नई उम्मीदें "</span>
    </div>

    <h2>User Login</h2>

    <!-- Display dynamic message -->
    <?php echo $message; ?>

    <form action="" method="POST">
    <div class="register-box">
        <label for="role">Select Role:</label>
        <select name="role" id="role">
            <option value="">--Select Role--</option>
            <option value="NormalUser">Normal User</option>
            <option value="WorkerUser">Worker User</option>
        </select><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email"><br><br>
        <!-- <p style="margin-left:30%; margin-bottom:1%;">Forgot Your Password ? <a href="./php/Forgot-password.php">Click Here</a></p> -->

        <label for="password">Password:</label>
        <input type="password" id="password" name="password"><br><br>

        <button type="submit">Login</button>
    </div>
    </form>

    <p>Don't have an account <a href="./Registration-form.php">Click Here</a></p>
</body>
</html>
