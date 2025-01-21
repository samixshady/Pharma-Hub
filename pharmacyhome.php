<?php
session_start();
if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
    session_write_close();
} else {
    // Since the username is not set in session, the user is not logged in
    // He is trying to access this page unauthorized
    // So let's clear all session variables and redirect him to index
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
<TITLE>Welcome</TITLE>
<link href="assets/css/phppot-style.css" type="text/css"
    rel="stylesheet" />
<link href="assets/css/dummy.css" type="text/css"
    rel="stylesheet" />
<style>
body {
  background-image: url("images/home.jpeg");
  background-color: #E0D9F0;
  background-repeat: no-repeat;
  background-size: cover; /* This ensures the image covers the entire background */
}
</style>	
</HEAD>
<BODY>
    <div class="phppot-container">
	<h1 class="title">User Homepage</h1>
        <div class="page-header">
            <span class="login-signup">
                <a href="user.php">BIO</a> | 
                <a href="review.php">Reviews</a> | 
                <a href="checkreviews.php">View Reviews</a>	|			
                <a href="logout.php">Logout</a>
				<br></br>
                <a href="deleteuser.php">Delete Account</a> |
                <a href="home.php">Back to home</a>
		</div>


</body> 
<body>      
        <div class="page-content">
            <h2>Pharmacies</h2>
			
			<div class="table-container">
            <?php
            if ($result->num_rows > 0) {
                echo "<table border='1'>
                        <tr>
							<th>ID</th>
                            <th>Pharmacy Name</th>
                            <th>Location</th>
                            <th>Phone</th>
							<th>View</th>
                        </tr>";
        
                while ($row = $result->fetch_assoc()) {
                    ?>
					
					<tr>
						<td><?=$row['store_ID']; ?></td>
						<td><?=$row['name']; ?></td>
						<td><?=$row['location']; ?></td>
						<td><?=$row['phone_number']; ?></td>
						<td>
							<a href="individual_pharmacy.php?store_ID=<?=$row['store_ID']; ?>" class="btn btn-success btn-sm">View</a>
						</td>
							
							
                        </tr>
						<?php
                }
        
                echo "</table>";
            } else {
                echo "No pharmacies found.";
            }
            ?>
			<div>
        </div>
    </div>
</BODY>
</HTML>
<?php
$conn->close();
?>
