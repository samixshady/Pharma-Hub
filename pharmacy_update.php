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
<HEAD>
<TITLE>Admin Homepage</TITLE>
<link href="assets/css/phppot-style.css" type="text/css"
    rel="stylesheet" />
</HEAD>

<BODY>
	<div class="phppot-container">
	<style>
        .container {
			position: absolute;
            width: 400px;
			float: center;
			top: 50;
			left: 350;
            margin: 1 auto;
            padding: 15px;
            border: 1px solid #665989;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .container label {
            display: inline-block;
            width: 110px;
            text-align: right;
            margin-right: 10px;
        }

        .container input[type="text"],
        .container input[type="number"] {
            width: 230px;
            padding: 5px;
            border: 1px solid #665989;
            border-radius: 3px;
        }

        .container input[type="submit"] {
            margin-left: 160px;
            background-color: #007bff;
            color: #665989;
            border: none;
            border-radius: 3px;
            padding: 10px 15px;
            cursor: pointer;
        }
		
		
    </style>
</BODY>



<body>
	<div class ="container">

	<h1>Update Pharmacy</h1>
	
		<?php
		if(isset($_GET["store_ID"]))
		{
			$store_ID = mysqli_real_escape_string($conn, $_GET['store_ID']);
			$query = "SELECT * FROM pharmacy WHERE store_ID='$store_ID' ";
			$query_run = mysqli_query($conn, $query);
			
			
			if(mysqli_num_rows($query_run) > 0)
			{
				$pharmacy = mysqli_fetch_array($query_run);
				?>
				
				<form action="code.php" method="post">
					<input type="hidden" name="store_ID" value="<?= $pharmacy['store_ID']; ?>"><br><br>
					
					<label for="name"> Name:</label>
					<input type="text" id="name" name="name" value="<?= $pharmacy['name']; ?>" required><br><br>
					
					<label for="phone_number">Phone Number:</label>
					<input type="int" id="phone_number" name="phone_number" value="<?= $pharmacy['phone_number']; ?>" required><br><br>
					
					<label for="location">Location:</label>
					<input type="text" id="location" name="location" value="<?= $pharmacy['location']; ?>" required><br><br>
					
					<button type="submit" name="update_pharmacy" class="btn btn-primary">Update Pharmacy</button>
					
				</form>
				
				
				<?php
			}
			else
			{
				echo "No Such ID found";
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
</HTML>