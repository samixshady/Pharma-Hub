<!DOCTYPE html>
<html>
<head>
    <title>SEARCH MEDICINE</title>
    <style>
        body {
			font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        #header {
            text-align: center;
            margin-bottom: 20px;
        }
        h1 {
            font-size: 48px;
            color: #008CBA;
            text-transform: uppercase;
            margin: 0;
        }
        #search-bar {
            text-align: center;
            margin-top: 10px;
        }
        #search-form {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }
        input[type="text"] {
            padding: 12px;
            font-size: 16px;
            border: 2px solid #008CBA;
            border-radius: 5px;
            width: 300px;
            margin-right: 10px;
        }
        button {
            padding: 12px 24px;
            font-size: 16px;
            background-color: #008CBA;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #005F7F;
        }
        #medicine-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .medicine-card {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 20px;
            margin: 10px;
            width: 250px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .medicine-card img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 10px;
            margin: 0 auto 10px;
            display: block;
        }
        .medicine-card p {
            margin: 0;
            font-size: 14px;
        }
		 body {
  background-image: url("images/home.jpeg");
  background-color: #cccccc;
  background-repeat: no-repeat;
  background-size: cover; /* This ensures the image covers the entire background */
}
.cart-section {
    background-color: #;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 5px;
    margin-top: 20px;
}

.cart-items {
    padding: 10px;
    background-color: #;
    border: 1px solid #ddd;
    border-radius: 5px;
}
.nav-button {
    background-color: #4CAF50;
    border: none;
    color: white;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    margin: 2px;
    cursor: pointer;
    border-radius: 4px;
}

.nav-button:hover {
    background-color: #45a049;
}
.checkout-button {
    background-color: #4CAF50;
    border: none;
    color: white;
    padding: 5px 10px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    margin: 10px 0;
    cursor: pointer;
    border-radius: 4px;
}

.checkout-button:hover {
    background-color: #45a049;
}

.checkout-link {
    color: white;
    text-decoration: none;
}
.search-button {
    background-color: #4CAF50;
    border: none;
    color: white;
    padding: 5px 10px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    margin: 2px;
    cursor: pointer;
    border-radius: 4px;
}

.search-button:hover {
    background-color: #45a049;
}
    </style>
</head>
<body>
    <div id="header">
        <h1>PHARMA-HUB</h1>
    </div>
    <div id="search-bar">
        <form id="search-form" action="search.php" method="GET">
            <input type="text" name="search" placeholder="Search for a medicine">
            <button type="submit">Search</button>
        </form>
    </div>
	<div class="page-header">
            <span class="login-signup"> 
			    <!-- ... sams code ... -->
				<button onclick="window.location.href='review.php'" class="nav-button">Reviews</button>
				<!-- ... sams code ... --> 
				<button onclick="window.location.href='checkreviews.php'" class="nav-button">View Reviews</button>
				<button onclick="window.location.href='modifypassword.php'" class="nav-button">Update Password</button>
				<button onclick="window.location.href='deleteuser.php'" class="nav-button">Delete Account</button>
				<button onclick="window.location.href='logout.php'" class="nav-button">Logout</button>
				<br><br>
				<button onclick="window.location.href='user.php'" class="nav-button">BIO</button>				
				<button onclick="window.location.href='pharmacyhome.php'" class="nav-button">Pharmacies </button><a<br></br>
				<a href="add_to_cart.php">Show My Cart</a>			
				<!-- ... sams code ... -->
				<br><br>
				<br></br>
            </span>
    </div>
    <div id="medicine-list">
        <!-- Medicine list will be displayed here using PHP -->
		<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pharma_hub";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
	$search = $_GET['search'];
	$sql = "SELECT * FROM medicines WHERE name LIKE '%$search%'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			echo "<div class='medicine-card'>";
			echo "<img src='" . $row['image_url'] . "' alt='" . $row['name'] . "'>";
			echo "<p><strong style='font-size: 20px; font-weight: bold;'>Name: </strong><span style='font-size: 20px;'>" . $row['name'] . "</span></p>";
			echo "<p><strong style='font-size: 20px; font-weight: bold;'>Description:</strong><span style='font-size: 20px;'>" . $row['description'] . "</span></p>";
			echo "<p><strong style='font-size: 20px; font-weight: bold;'>Price:</strong> Tk." . $row['price'] . "</p>";
			echo "<p><strong style='font-size: 20px; font-weight: bold;'>Manufacturer:</strong> " . $row['manufacturer'] . "</p>";
			echo "<p><strong style='font-size: 20px; font-weight: bold;'>Expiry date:</strong> " . $row['expiry_date'] . "</p>";
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
</html>
