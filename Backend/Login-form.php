<?php
// Include the logic file to handle the login logic
include './php/Login-form.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>User Login</h2>

    <!-- Display dynamic message -->
    <?php echo $message; ?>

    <form action="" method="POST">
        <label for="role">Select Role:</label>
        <select name="role" id="role">
            <option value="">--Select Role--</option>
            <option value="NormalUser">Normal User</option>
            <option value="WorkerUser">Worker User</option>
        </select><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email"><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password"><br><br>

        <button type="submit">Login</button>
    </form>
</body>
</html>
