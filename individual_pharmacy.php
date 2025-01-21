<?php
session_start();
if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
    session_write_close();
} else {
    // since the username is not set in session, the user is not-logged-in
    // he is trying to access this page unauthorized
    // so let's clear all session variables and redirect him to index
    session_unset();
    session_write_close();
    $url = "./index.php";
    header("Location: $url");
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

// Retrieve pharmacies from the database
$sql = "SELECT * FROM pharmacy";
$result = $conn->query($sql);
?>


<HTML>

<BODY>
	<div class="phppot-container">
	<style>
        .container {
            width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .container label {
            display: inline-block;
            width: 150px;
            text-align: right;
            margin-right: 10px;
        }

        .container input[type="text"],
        .container input[type="number"] {
            width: 230px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .container input[type="submit"] {
            margin-left: 160px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            padding: 8px 15px;
            cursor: pointer;
        }
    </style>
</BODY>



<body>
	<div class ="container">
	
		<?php
		if(isset($_GET["store_ID"]))
		{
			$store_ID = mysqli_real_escape_string($conn, $_GET['store_ID']);
			$query = "SELECT  medicine_list.medicine_name, medicine_list.price, pharmacy_stores_medicine.stock, pharmacy.name FROM 
			((medicine_list INNER JOIN pharmacy_stores_medicine ON pharmacy_stores_medicine.drug_ID = medicine_list.drug_ID) INNER JOIN
			 pharmacy ON pharmacy_stores_medicine.store_ID = pharmacy.store_ID) WHERE pharmacy_stores_medicine.store_ID = '$store_ID' ";
			 
			$query_run = mysqli_query($conn, $query);
			
			
			if(mysqli_num_rows($query_run) > 0)
			{
				echo "<h3>Pharamcy ID: $store_ID</h3>";
				echo "<table border='1'>
					<tr>
						<th>Medicine Name</th>
						<th>Price (Taka)</th>
						<th>Stock Quanity</th>
					</tr>";
					
				while($row = mysqli_fetch_array($query_run))
				{
					echo "<tr>
							<td>".$row['medicine_name']."</td>
							<td>".$row['price']."</td>
							<td>".$row['stock']."</td>
						</tr>";
				}
				?>
				
				
				
				<?php
			}
			else
			{
				echo "No Medicine Found";
			}
		}
		?>
		
	</div>
	
<style>
body {
  background-image: url("images/home.jpeg");
  background-color: #E0D9F0;
  background-repeat: no-repeat;
  background-size: cover; /* This ensures the image covers the entire background */
}
</style>	
</BODY>

<?php
$conn->close();
?>
