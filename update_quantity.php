<?php
session_start();

if (!isset($_SESSION["username"])) {
    // Redirect to login if not logged in
    $url = "./index.php";
    header("Location: $url");
    exit();
}

if (isset($_GET["action"]) && isset($_GET["id"])) {
    $action = $_GET["action"];
    $medicine_id = $_GET["id"];
    $username = $_SESSION["username"];

    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "pharma_hub";

    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the current quantity of the medicine in the user's cart
    $quantity_sql = "SELECT quantity FROM user_carts WHERE username = '$username' AND medicine_id = $medicine_id";
    $quantity_result = $conn->query($quantity_sql);
    
    if ($quantity_result->num_rows > 0) {
        $quantity_row = $quantity_result->fetch_assoc();
        $current_quantity = $quantity_row['quantity'];

        // Update the quantity based on the action
        if ($action === "increase") {
            $new_quantity = $current_quantity + 1;
        } elseif ($action === "decrease") {
            $new_quantity = max($current_quantity - 1, 1); // Ensure quantity is at least 1
        }

        // Update the quantity in the database
        $update_sql = "UPDATE user_carts SET quantity = $new_quantity WHERE username = '$username' AND medicine_id = $medicine_id";
        $conn->query($update_sql);
    }

    $conn->close();

    // Redirect back to the cart page
    $url = "home.php#cart-section"; // Adjust this URL to match your page structure
    header("Location: $url");
    exit();
} else {
    // Redirect back to the home page
    $url = "home.php";
    header("Location: $url");
    exit();
}
?>
