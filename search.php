<!DOCTYPE html>
<html>
<head>
    <title>SEARCH MEDICINE</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        #search-bar {
            margin-top: 20px;
        }
        #medicine-list {
            margin-top: 20px;
        }
		.add-to-cart-box {
		display: inline-block;
		border: 2px solid #007bff;
		padding: 5px;
		margin-top: 10px;
		}

    </style>
</head>
<body>
    <h1>PHARMA-HUB</h1>
    <div id="search-bar">
        <form action="search.php" method="GET">
            <input type="text" name="search" placeholder="Search for a medicine">
            <button type="submit">Search</button>
        </form>
    </div>
    <div id="medicine-list">
        <!-- Medicine list will be displayed here using PHP -->
		<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pharmacy";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$search = $_GET['search'];

$sql = "SELECT * FROM medicines WHERE name LIKE '%$search%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
		echo "<div>";
        echo "<img src='" . $row['image_url'] . "' alt='" . $row['name'] . "'>";
        echo "<p><strong>Name:</strong> " . $row['name'] . "<br>";
        echo "<strong>Description:</strong> " . $row['description'] . "<br>";
        echo "<strong>Price:</strong> Tk." . $row['price'] . "<br>";
		echo "<strong>Manufacturer:</strong> " . $row['manufacturer'] . "<br>";
		echo "<strong>Expiry date:</strong> " . $row['expiry_date'] . "</br>";
		
		echo "<a href='add_to_cart.php?medicine_id=" . $row['id'] . "' class='add-to-cart' style='font-weight: bold;'>Add to Cart</a>";


		echo "</div>";
    }
} else {
    echo "No medicines found.";
}

$conn->close();
?>

    </div>

</body>
</html>
<!DOCTYPE html>
<html>
<head>
<style>
body  {
  background-image: url("images/medicines-medical-supplies-placed-blue.jpg");
  background-color: #cccccc;
}
</style>
</head>