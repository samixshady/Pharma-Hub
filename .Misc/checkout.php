<?php
session_start();
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

if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
} else {
    // Redirect if not logged in
    $url = "index.php";
    header("Location: $url");
    exit();
}

$cart_sql = "SELECT user_carts.*, medicines.price FROM user_carts JOIN medicines ON user_carts.medicine_id = medicines.id WHERE username = '$username'";
$cart_result = $conn->query($cart_sql);

$total_price = 0;
$cart_items = array();

while ($cart_row = $cart_result->fetch_assoc()) {
    $item_price = $cart_row['price'] * $cart_row['quantity'];
    $total_price += $item_price;
    
    $cart_items[] = array(
        "medicine_name" => $cart_row['medicine_name'],
        "quantity" => $cart_row['quantity'],
        "price" => $item_price
    );
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <!-- Add your stylesheets here -->
</head>
<body>
    <h1>Checkout</h1>
    <table border='1'>
        <tr>
            <th>Medicine Name</th>
            <th>Quantity</th>
            <th>Price</th>
        </tr>
        <?php foreach ($cart_items as $item) { ?>
            <tr>
                <td><?php echo $item['medicine_name']; ?></td>
                <td><?php echo $item['quantity']; ?></td>
                <td><?php echo "$" . $item['price']; ?></td>
            </tr>
        <?php } ?>
    </table>
    <p>Total Price: $<?php echo $total_price; ?></p>
    <a href="comepletecheckout.php">Complete Checkout</a>
</body>
</html>