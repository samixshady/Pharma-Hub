<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .checkout-container {
            max-width: 1000px;
            margin: 80px auto;
            background-color: #;
            display: flex;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .order-details {
            flex: 1;
            background-color: #;
            padding: 20px;
            border-radius: 5px 0 0 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .order-details h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .order-details ul {
            list-style: none;
            padding-left: 0;
        }

        .order-details li {
            margin-bottom: 10px;
        }

        .checkout-form {
            flex: 1;
            padding: 20px;
            border-radius: 0 5px 5px 0;
        }

        .checkout-header {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .checkout-form label,
        .checkout-form input,
        .checkout-form select {
            display: block;
            margin-bottom: 15px;
            width: 90%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .checkout-form select {
            width: auto;
        }

        .checkout-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 3px;
            cursor: pointer;
        }

        .checkout-button:hover {
            background-color: #00008B;
        }

        .total-price-box {
            margin-top: 20px;
            padding: 10px;
            background-color: #f7f7f7;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="checkout-container">
        <div class="order-details">
            <h2>Order Details</h2>
            <ul>
                <?php
                session_start();

                if (!isset($_SESSION["username"])) {
                    // Redirect to login if not logged in
                    $url = "./index.php";
                    header("Location: $url");
                    exit();
                }

                $username = $_SESSION["username"];

                $servername = "localhost";
                $db_username = "root";
                $db_password = "";
                $dbname = "pharma_hub";

                $conn = new mysqli($servername, $db_username, $db_password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Retrieve cart items for the user
                $cart_sql = "SELECT user_carts.*, medicines.price FROM user_carts JOIN medicines ON user_carts.medicine_id = medicines.id WHERE username = '$username'";
                $cart_result = $conn->query($cart_sql);

                $cart_items = array();

                while ($cart_row = $cart_result->fetch_assoc()) {
                    $item_price = $cart_row['price'] * $cart_row['quantity'];
                    $cart_items[] = array(
                        "medicine_name" => $cart_row['medicine_name'],
                        "quantity" => $cart_row['quantity'],
                        "price" => $item_price
                    );
                }

                $conn->close();

                // Loop through cart items and display in the order details
                foreach ($cart_items as $item) {
                    echo "<li><strong>" . $item['medicine_name'] . "</strong> - Quantity: " . $item['quantity'] . " - Price: $" . $item['price'] . "</li>";
                }
                ?>
            </ul>
            <div class="total-price-box">
                <strong>Total Price: $<?php echo array_sum(array_column($cart_items, 'price')); ?></strong>
            </div>
        </div>
        <form class="checkout-form" method="POST" action="process_checkout.php">
            <h2 class="checkout-header">Checkout</h2>
            <label for="payment_option">Payment Option:</label>
            <select name="payment_option" required>
                <option value="credit_card">Credit Card</option>
                <option value="bkash">bkash</option>
                <option value="cash_on_delivery">Cash on Delivery</option>
            </select>
            
            <label for="road_number">Road Number:</label>
            <input type="text" name="road_number" required>
            
            <label for="flat_number">Flat Number:</label>
            <input type="text" name="flat_number" required>
            
            <label for="area">Area:</label>
            <input type="text" name="area" required>
            
            <label for="zip_code">Zip Code:</label>
            <input type="text" name="zip_code" required>
            
            <label for="district">District:</label>
            <input type="text" name="district" required>
            
            <label for="city">City:</label>
            <input type="text" name="city" required>

            <button class="checkout-button" type="submit">Complete Order</button>
        </form>
    </div>
</body>
</html>
