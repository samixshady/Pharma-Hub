<?php
session_start();

if (!isset($_SESSION["username"])) {
    // Redirect to login if not logged in
    $url = "./index.php";
    header("Location: $url");
    exit();
}

if (isset($_GET["medicine_id"])) {
    $medicine_id = $_GET["medicine_id"];
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
        $insert_sql = "INSERT INTO user_carts (username, medicine_id, medicine_name, quantity) SELECT '$username', id, name, 1 FROM medicines WHERE id = $medicine_id";
        $conn->query($insert_sql);
    }

    // Fetch cart items and calculate total price
    $cart_sql = "SELECT user_carts.*, medicines.price, medicines.name AS medicine_name FROM user_carts JOIN medicines ON user_carts.medicine_id = medicines.id WHERE username = '$username'";
    $cart_result = $conn->query($cart_sql);

    // Close the connection
    $conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Added to Cart</title>
    <style>
	    body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f1f1f1;
            margin: 0;
        }
        .cart-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .cart-items {
            margin-top: 20px;
        }
        .cart-items ul {
            list-style: none;
            padding: 0;
        }
        .cart-items li {
            margin: 10px 0;
        }
        .total-price {
            margin-top: 20px;
            font-weight: bold;
            font-size: 18px;
        }
        .back-link {
            display: block;
            margin-top: 20px;
            font-size: 18px;
        }
		.checkout-button {
            margin-top: 20px;
        }
    
    </style>
</head>
<body>
    <div class="cart-container">
        <h1>Added to Cart</h1>
        <?php
        if ($cart_result->num_rows > 0) {
            echo "<h2>Your Cart</h2>";
            $total_price = 0;
            echo "<div class='cart-items'>";
            echo "<ul>";
            while ($cart_row = $cart_result->fetch_assoc()) {
                $item_price = $cart_row['price'] * $cart_row['quantity'];
                $total_price += $item_price;
                echo "<li>".$cart_row['medicine_name']." - Quantity: ".$cart_row['quantity']." - Price: Tk.".$item_price."</li>";
            }
            echo "</ul>";
            echo "<p class='total-price'>Total Price: Tk.".$total_price."</p>";

            // Add a button to drop everything from cart
            echo "<form action='drop_cart.php' method='post'>";
            echo "<input type='submit' value='Drop Everything from Cart'>";
            echo "</form>";

            echo "</div>";
			echo "<div class='checkout-button'>";
            echo "<a href='checkout.php'>Checkout</a>";
            echo "</div>";
        } else {
            echo "<p>Your cart is empty.</p>";
        }
        ?>
        <a href="home.php" class="back-link">Back to Home</a>
    </div>
</body>
</html>

