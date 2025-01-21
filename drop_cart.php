<?php
session_start();
if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
} else {
    // If the user is not logged in, redirect to the index page
    header("Location: ./login.php");
    exit();
}

$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "pharma_hub";

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Delete all items from user's cart
$delete_cart_sql = "DELETE FROM user_carts WHERE username = '$username'";
if ($conn->query($delete_cart_sql) === TRUE) {
    // Cart items successfully deleted
    header("Location: home.php"); // Redirect back to user's account page
    exit();
} else {
    echo "Error deleting cart items: " . $conn->error;
}

$conn->close();
?>
