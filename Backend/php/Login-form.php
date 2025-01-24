<?php
// Initialize message variable
$message = "";

// Database connection (adjust with your own credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aashyean-db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $role = $_POST['role'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate the required fields
    if (empty($role) || empty($email) || empty($password)) {
        $message = "<p style='color: red;'>Please fill in all required fields.</p>";
    } else {
        // Check user role and validate credentials
        if ($role == "NormalUser") {
            $sql = "SELECT * FROM NormalUser WHERE email = '$email'";
        } elseif ($role == "WorkerUser") {
            $sql = "SELECT * FROM WorkerUser WHERE email = '$email'";
        } else {
            $message = "<p style='color: red;'>Invalid role selected.</p>";
        }

        // Execute the query to check the user in the corresponding table
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Fetch user data
            $user = $result->fetch_assoc();

            // Verify the password
            if (password_verify($password, $user['password'])) {
                $message = "<p style='color: green;'>Login successful. Welcome, " . $user['name'] . "!</p>";
                header('Location: dashboard.php');
                exit;
            } else {
                $message = "<p style='color: red;'>Incorrect password.</p>";
            }
        } else {
            $message = "<p style='color: red;'>No user found with the given email.</p>";
        }
    }
}

// Close connection
$conn->close();
?>
