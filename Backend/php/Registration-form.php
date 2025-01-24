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
    // Get form values
    $role = $_POST['role'];

    // If Normal User
    if ($role == 'NormalUser') {
        $contact = $_POST['user_contact'];
        $name = $_POST['user_name'];
        $email = $_POST['user_email'];
        $password = $_POST['user_password'];
        $locations = $_POST['user_locations'];
        $gender = $_POST['user_gender'];
        $date = date("Y-m-d H:i:s");

        // Validate required fields for Normal User
        if (empty($name) || empty($email) || empty($contact) || empty($locations) || empty($gender)) {
            $message = "<p style='color: red;'>Please fill in all required fields for Normal User.</p>";
        } else {
            // Hash the password for security
            $password = password_hash($password, PASSWORD_DEFAULT);

            // Check if email already exists
            $sqlCheck = "SELECT * FROM NormalUser WHERE email = '$email'";
            $resultCheck = $conn->query($sqlCheck);
            if ($resultCheck->num_rows > 0) {
                $message = "<p style='color: red;'>Email already exists. Please use a different email.</p>";
            } else {
                // Insert into NormalUser table
                $sql = "INSERT INTO NormalUser (name, email, password, contact, locations, gender, date) 
                        VALUES ('$name', '$email', '$password', '$contact', '$locations', '$gender', '$date')";

                if ($conn->query($sql) === TRUE) {
                    $message = "<p style='color: green;'>Registration successful for Normal User!</p>";
                } else {
                    $message = "<p style='color: red;'>Error: " . $conn->error . "</p>";
                }
            }
        }

    // If Worker User
    } elseif ($role == 'WorkerUser') {
        $name = $_POST['worker_name'];
        $email = $_POST['worker_email'];
        $password = $_POST['worker_password'];
        $dateOfBirth = $_POST['dateOfBirth'];
        $gender = $_POST['worker_gender'];

        // Validate required fields for Worker User
        if (empty($name) || empty($email) || empty($password) || empty($dateOfBirth) || empty($gender)) {
            $message = "<p style='color: red;'>Please fill in all required fields for Worker User.</p>";
        } else {
            // Hash the password for security
            $password = password_hash($password, PASSWORD_DEFAULT);

            // Check if email already exists
            $sqlCheck = "SELECT * FROM WorkerUser WHERE email = '$email'";
            $resultCheck = $conn->query($sqlCheck);
            if ($resultCheck->num_rows > 0) {
                $message = "<p style='color: red;'>Email already exists. Please use a different email.</p>";
            } else {
                // Insert into WorkerUser table
                $sql = "INSERT INTO WorkerUser (name, email, password, dateOfBirth, gender) 
                        VALUES ('$name', '$email', '$password', '$dateOfBirth', '$gender')";

                if ($conn->query($sql) === TRUE) {
                    $message = "<p style='color: green;'>Registration successful for Worker User!</p>";
                } else {
                    $message = "<p style='color: red;'>Error: " . $conn->error . "</p>";
                }
            }
        }
    }
}

// Close connection
$conn->close();
?>
