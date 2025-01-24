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

// Include the logic file to handle the registration logic
include './php/Registration-form.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link href="./style/authentication.css" rel="stylesheet">
    <script>
        // Function to show/hide fields based on selected role
        function toggleFormFields() {
            var role = document.getElementById("role").value;

            // Hide all fields initially
            document.getElementById("normalUserFields").style.display = "none";
            document.getElementById("workerUserFields").style.display = "none";

            // Show the appropriate fields based on the role selected
            if (role === "NormalUser") {
                document.getElementById("normalUserFields").style.display = "block";
            } else if (role === "WorkerUser") {
                document.getElementById("workerUserFields").style.display = "block";
            }
        }
    </script>
</head>
<body>

    <div class="navbar">
        <span class="title">आशाएं</span>
        <span class="tagline">" नवीन दिशा, नई उम्मीदें "</span>
    </div>

    <h2>User Registration</h2>

    <!-- Display dynamic message -->
    <?php echo $message; ?>

    <form action="" method="POST">
    <div class="register-box">
        <label for="role">Select Role:</label>
        <select name="role" id="role" onchange="toggleFormFields()">
            <option value="">--Select Role--</option>
            <option value="NormalUser">Normal User</option>
            <option value="WorkerUser">Worker User</option>
        </select>

        <!-- Normal User Fields -->
        <div id="normalUserFields" style="display: none">
            <h3>Normal User Registration</h3>
            <label for="user_name">Name:</label>
            <input type="text" id="user_name" name="user_name"><br><br>

            <label for="user_email">Email:</label>
            <input type="email" id="user_email" name="user_email"><br><br>

            <label for="user_password">Password:</label>
            <input type="password" id="user_password" name="user_password"><br><br>

            <label for="user_contact">Contact:</label>
            <input type="text" id="user_contact" name="user_contact"><br><br>

            <label for="user_locations">Locations:</label>
            <input type="text" id="user_locations" name="user_locations"><br><br>

            <label for="user_gender">Gender:</label>
            <select name="user_gender" id="user_gender">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select><br><br>
        </div>

        <!-- Worker User Fields -->
        <div id="workerUserFields" style="display: none">
            <h3>Worker User Registration</h3>
            <label for="worker_name">Name:</label>
            <input type="text" id="worker_name" name="worker_name"><br><br>

            <label for="worker_email">Email:</label>
            <input type="email" id="worker_email" name="worker_email"><br><br>

            <label for="worker_password">Password:</label>
            <input type="password" id="worker_password" name="worker_password"><br><br>

            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dateOfBirth"><br><br>

            <label for="worker_gender">Gender:</label>
            <select name="worker_gender" id="worker_gender">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select><br><br>
        </div>

        <button type="submit">Register</button>
    </div>
    </form>

    <p>Already have an account <a href="./Login-form.php">Click Here</a></p>
</body>
</html>
