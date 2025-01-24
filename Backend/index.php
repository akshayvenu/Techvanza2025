<?php
session_start();

// ini_set('display_errors','Off');

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header('Location: Login-Form.php'); // Redirect to login page if not logged in
    exit;
}

// Welcome message
$role = $_SESSION['role'];
$name = $_SESSION['name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="./style/authentication.css" rel="stylesheet">
    <style>
        .user-details {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 20px auto;
        }

        .user-details h3 {
            margin-bottom: 10px;
            color: #1976d2;
        }

        .user-details ul {
            list-style: none;
            padding: 0;
        }

        .user-details ul li {
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }

        .user-details ul li:last-child {
            border-bottom: none;
        }

        .navbar {
            background-color: #1976d2;
            color: white;
            padding: 10px 20px;
            text-align: center;
        }

        .navbar .title {
            font-size: 24px;
            font-weight: bold;
        }

        .navbar .tagline {
            font-size: 14px;
            font-style: italic;
            color: #e0e0e0;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-top: 20px;
        }

        .logout-btn {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #e53935;
            color: white;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-align: center;
            text-decoration: none;
            max-width: 150px;
        }

        .logout-btn:hover {
            background-color: #c62828;
        }
    </style>
</head>
<body>

    <div class="navbar">
        <span class="title">आशाएं</span>
        <span class="tagline">" नवीन दिशा, नई उम्मीदें "</span>
    </div>

    <h2>Welcome, <?php echo htmlspecialchars($name); ?>!</h2>
    
    <div class="user-details">
        <h3>Your Details:</h3>
        <ul>
        <?php
foreach ($_SESSION as $key => $value) {
    echo "<li><strong>" . ucfirst(htmlspecialchars($key)) . ":</strong> ";

    // Check if the value is an array
    if (is_array($value)) {
        echo "<pre>" . htmlspecialchars(print_r($value, true)) . "</pre>";
    } else {
        echo htmlspecialchars($value);
    }

    echo "</li>";
}
?>
        </ul>
    </div>

    <!-- Logout Button -->
    <a href="./php/Logout.php" class="logout-btn">Logout</a>

</body>
</html>
