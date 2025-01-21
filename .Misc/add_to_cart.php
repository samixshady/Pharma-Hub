<?php
session_start();

if (!isset($_SESSION["username"])) {
    // Redirect to login if not logged in
    $url = "./index.php";
    header("Location: $url");
    exit();
}

if (isset($_GET["id"])) {
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

    // Check if the medicine is already in the user's cart
    $check_sql = "SELECT * FROM user_carts WHERE username = '$username' AND medicine_id = $medicine_id";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        // Medicine already in cart, update quantity
        $conn->query("UPDATE user_carts SET quantity = quantity + 1 WHERE username = '$username' AND medicine_id = $medicine_id");
    } else {
        // Medicine not in cart, insert new entry
        $insert_sql = "INSERT INTO user_carts (username, medicine_id, medicine_name, quantity) SELECT '$username', id, medicine_name, 1 FROM medicines WHERE id = $medicine_id";
        $conn->query($insert_sql);
    }

    $conn->close();

    // Redirect back to the home page
    $url = "home.php";
    header("Location: $url");
    exit();
}
?>
