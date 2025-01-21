<?php
session_start();
if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
    session_write_close();
} else {
    session_unset();
    session_write_close();
    $url = "./index.php";
    header("Location: $url");
}

$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "pharma_hub";

$conn = new mysqli($servername, $db_username, $db_password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $medicineId = $_POST['medicine_id'];
    $newStock = $_POST['new_stock'];

    $updateSql = "UPDATE medicines SET stock = $newStock WHERE id = $medicineId";
    
    if ($conn->query($updateSql) === TRUE) {
        echo "Stock updated successfully!";
    } else {
        echo "Error updating stock: " . $conn->error;
    }
}

$sql = "SELECT * FROM medicines";
$result = $conn->query($sql);
?>

<HTML>
<HEAD>
<TITLE>Modify Stock</TITLE>
<link href="assets/css/phppot-style.css" type="text/css"
    rel="stylesheet" />
<link href="assets/css/user-registration.css" type="text/css"
    rel="stylesheet" />
<style>
body {
  background-image: url("images/home.jpeg");
  background-color: #cccccc;
  background-repeat: no-repeat;
  background-size: cover;
}
</style>	
</HEAD>
<BODY>
    <div class="phppot-container">
        <div class="page-header">
	    <a href="adminhome.php">Back To Admin Homepage</a> | 
        </div>
        <div class="page-content">
            <h2>Modify Stock</h2>
            <form method="post">
                <label for="medicine_id">Select Medicine:</label>
                <select id="medicine_id" name="medicine_id">
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['id'] . "'>" . $row['medicine_name'] . "</option>";
                    }
                    ?>
                </select><br><br>
                
                <label for="new_stock">New Stock:</label>
                <input type="number" id="new_stock" name="new_stock" required><br><br>
                
                <input type="submit" value="Update Stock">
            </form>
        </div>
    </div>
</BODY>
</HTML>
<?php
$conn->close();
?>
