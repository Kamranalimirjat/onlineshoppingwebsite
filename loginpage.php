<?php
session_start();

// Database connection
$servername = "localhost";
$db_user = "root";
$db_pass = "";
$database = "online_shopping";

$conn = new mysqli($servername, $db_user, $db_pass, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get POST data
$username = $_POST['user'] ?? '';
$password = $_POST['pass'] ?? '';

// Check if user exists
$stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 1) {
    $stmt->bind_result($hashed_password);
    $stmt->fetch();

    // Verify password
    if (password_verify($password, $hashed_password)) {
        // Store user in session
        $_SESSION['user'] = $username;

        // Redirect to index.html
        header("Location: http://localhost/Online Shopping Website/index.html");
        exit();
    } else {
        // Wrong password
        showLoginForm("Invalid password.");
    }
} else {
    // User not found
    header("Location: http://localhost/Online Shopping Website/register.html");
    exit();
}

$stmt->close();
$conn->close();

// Function to show login form with error
function showLoginForm($message) {
    echo "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Login Error</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #fff3f3;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }
            .container {
                background-color: white;
                padding: 2rem;
                border-radius: 10px;
                box-shadow: 0 8px 16px rgba(0,0,0,0.1);
                width: 100%;
                max-width: 400px;
                text-align: center;
            }
            h2 {
                color: red;
                margin-bottom: 1rem;
            }
            a {
                display: inline-block;
                margin-top: 20px;
                text-decoration: none;
                color: #4caf50;
            }
        </style>
    </head>
    <body>
        <div class='container'>
            <h2>$message</h2>
            <a href='login.html'>Try Again</a>
        </div>
    </body>
    </html>";
}
?>
