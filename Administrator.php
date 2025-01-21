<?php
session_start();

// Replace with your actual database connection details
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'pharma_hub';

$conn = new mysqli($hostname, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];

// Sanitize inputs before using them in SQL queries
$username = $conn->real_escape_string($username);

$query = "SELECT * FROM admins WHERE username = '$username'";
$result = $conn->query($query);

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $dbPassword = $row['password'];

    // Compare the provided password with the one stored in the database
    if ($password === $dbPassword) {
        $_SESSION['username'] = $username;
        header("Location: home.php");
        exit();
    } else {
        echo "Wrong password.";
    }
} else {
    echo "Username not found.";
}

$conn->close();
?>
