<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Pharma_Hub";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM user";
$result = $conn->query($sql);

$userData = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $userData[] = $row;
    }
}
// ... (Previous code) ...

if (isset($_GET["search-name"]) && !empty($_GET["search-name"])) {
    $searchName = $_GET["search-name"];
    
    $sql = "SELECT * FROM user WHERE user_name LIKE '%$searchName%'";
    $result = $conn->query($sql);
    
    $userData = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $userData[] = $row;
        }
    } else {
        $searchMessage = "No matching records found.";
    }
}

$conn->close();
?>



<!DOCTYPE html>
<html>
<head>
    <title>PHARMA-HUB - User Information</title>
    <link href="assets/css/phppot-style.css" type="text/css" rel="stylesheet" />
    <link href="assets/css/view-users.css" type="text/css" rel="stylesheet" /> <!-- Add your custom CSS for styling -->
    <script src="vendor/jquery/jquery-3.3.1.js" type="text/javascript"></script>
</head>
<body>
<div class="search-container">
    <form method="get">
        <input type="text" name="search-name" placeholder="Search by Name">
        <button type="submit">Search</button>
								<a href="adminhome.php">Admin Homepage</a>

    </form>
</div>

    <div class="phppot-container">
        <div class="user-list-container">
            <h2>User Information</h2>
            <div class="user-list">
                <?php foreach ($userData as $user) { ?>
                    <div class="user-card">
                        <div class="user-field"><strong>Name:</strong> <?php echo $user["user_name"]; ?></div>
                        <div class="user-field"><strong>Phone:</strong> <?php echo $user["phone"]; ?></div>
                        <div class="user-field"><strong>Email:</strong> <?php echo $user["email"]; ?></div>
                        <div class="user-field"><strong>Age:</strong> <?php echo $user["age"]; ?></div>
                        <div class="user-field"><strong>Address:</strong> <?php echo $user["address"]; ?></div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="page-footer">
            
        </div>
    </div>
</body>
</html>

