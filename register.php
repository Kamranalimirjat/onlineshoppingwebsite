<?php
// Step 1: Connect to the database
$servername = "localhost";
$db_user = "root";
$db_pass = "";
$database = "online_shopping";

$conn = new mysqli($servername, $db_user, $db_pass, $database);

// Step 2: Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 3: Get form data
$username = $_POST['user'] ?? '';
$password = $_POST['pass'] ?? '';

// Step 4: Validate input
if (trim($username) === '' || trim($password) === '') {
    die("Please fill in all fields.");
}

// Step 5: Hash password
$hashed_pass = password_hash($password, PASSWORD_DEFAULT);

// Step 6: Insert into DB
$stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $hashed_pass);

if ($stmt->execute()) {
    // ✅ Registration successful, show login button
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Registration Successful</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #e6ffe6;
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
                box-shadow: 0 4px 12px rgba(0,0,0,0.1);
                text-align: center;
            }
            h2 {
                color: #2e7d32;
            }
            a.button {
                display: inline-block;
                margin-top: 20px;
                padding: 10px 20px;
                background-color: #1976d2;
                color: white;
                text-decoration: none;
                border-radius: 5px;
                font-size: 16px;
                transition: background-color 0.3s ease;
            }
            a.button:hover {
                background-color: #1259a1;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h2>Registration Successful!</h2>
            <p>Your account has been created successfully.</p>
            <a class="button" href="Loginpage.html">Login Now</a>
        </div>
    </body>
    </html>
    <?php
} else {
    // Show error if registration failed
    echo "Error: " . $stmt->error;
}

// Close database resources
$stmt->close();
$conn->close();
?>
