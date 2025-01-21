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
<link href="assets/css/dummy2.css" type="text/css"
    rel="stylesheet" />
<link href="assets/css/dummy.css" type="text/css"
    rel="stylesheet" />

</HEAD>
<BODY>
    <div class="phppot-container">
	<h1 class="title">Admin Homepage</h1>
        <div class="page-header">
            <span class="login-signup">
                <a href="user.php">BIO</a> | 
                <a href="review.php">Reviews</a> | 
				<a href="checkreviews.php">View Reviews</a>	|			
                <a href="userinformation.php">User Information</a>	|			
                <a href="logout.php">Logout</a>
				<br></br>
                <a href="deleteuser.php">Delete Account</a>
		</div>
	</div>
	<style>
        .container {
			position: absolute;
            width: 400px;
			float: right;
			top: 140;
            right: 100;
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
		
		.table-container {
			display: flex;
			justify-content: left;
			align-items: flex-start;
			margin-left: 50px;
		}
		
		.table-header {
			text-align: left;
			margin-left: 50px;
			
		}
		
		
    </style>
</body>
<body>
	<div class="page-content">
		<h2 class="table-header">Existing Pharmacies</h2>
		
		<div class="table-container">
		<?php
		if ($result->num_rows > 0) {
			echo "<table border='1'>
					<tr>
						<th>ID</th>
						<th>Pharmacy Name</th>
						<th>Phone Number</th>
						<th>Location</th>
						<th>Action</th>
					</tr>";

			while ($row = $result->fetch_assoc()) {
				?>
				
				<tr>
					<td><?=$row['store_ID']; ?></td>
					<td><?=$row['name']; ?></td>
					<td><?=$row['phone_number']; ?></td>
					<td><?=$row['location']; ?></td>
					<td>
						<a href="pharmacy_update.php?store_ID=<?= $row['store_ID']; ?>" class="btn btn-success btn-sm">Update</a>
						
						<form action="code.php" method="POST" class="d-inline">
							<button type="submit" name="delete_pharmacy" value="<?=$row['store_ID']; ?>" class="btn btn-danger btn-sm">Delete</button>
						</form>
					</td>
						
						
					</tr>
					<?php
			}

			echo "</table>";
		} else {
			echo "No pharmacies found.";
		}
		?>
	</div>
	<div class ="container">

	<h2>Add New Pharmacy</h2>
		<form action="code.php" method="post">
			<label for="store_ID">Store ID:</label>
			<input type="int" id="store_ID" name="store_ID" required><br><br>
			
			<label for="name"> Name:</label>
			<input type="text" id="name" name="name" required><br><br>
			
			<label for="phone_number">Phone Number:</label>
			<input type="int" id="phone_number" name="phone_number" required><br><br>
			
			<label for="location">Location:</label>
			<input type="text" id="location" name="location" required><br><br>
			
			<button type="submit" name="add_pharmacy" class="btn btn-primary">Add Pharmacy</button>
			
		</form>
		
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