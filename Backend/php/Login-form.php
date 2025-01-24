<?php
session_start(); // Start session

// Initialize message variable
$message = "";

// Database connection
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

    // Validate required fields
    if (empty($role) || empty($email) || empty($password)) {
        $message = "<p style='color: red;'>Please fill in all required fields.</p>";
    } else {
        // Select appropriate table based on the role
        if ($role == "NormalUser") {
            $sql = "SELECT * FROM NormalUser WHERE email = ?";
        } elseif ($role == "WorkerUser") {
            $sql = "SELECT * FROM WorkerUser WHERE email = ?";
        } else {
            $message = "<p style='color: red;'>Invalid role selected.</p>";
        }

        if (isset($sql)) {
            // Prepare statement
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Fetch user data
                $user = $result->fetch_assoc();

                // Verify password
                if (password_verify($password, $user['password'])) {
                    // Save user details in session
                    $_SESSION['role'] = $role;
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['name'] = $user['name'];
                    $_SESSION['email'] = $user['email'];

                    if ($role == "NormalUser") {
                        $_SESSION['contact'] = $user['contact'];
                        $_SESSION['locations'] = $user['locations'];
                        $_SESSION['gender'] = $user['gender'];
                    } elseif ($role == "WorkerUser") {
                        $_SESSION['dateOfBirth'] = $user['dateOfBirth'];
                        $_SESSION['gender'] = $user['gender'];
                    }

                    // Redirect to dashboard
                    header('Location: index.php');
                    exit;
                } else {
                    $message = "<p style='color: red;'>Incorrect password.</p>";
                }
            } else {
                $message = "<p style='color: red;'>No user found with the given email.</p>";
            }

            $stmt->close();
        }
    }
}

// Close connection
$conn->close();
?>