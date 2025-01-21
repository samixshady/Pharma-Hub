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


// Retrieve medicines from the database
$sql = "SELECT * FROM pharmacy_stores_medicine";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h1>List of Medicines</h1>";
    echo "<table border='1'>
            <tr>
                <th>Store ID</th>
                <th>Drug ID</th>
                <th>Stock</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".$row['store_ID']."</td>
                <td>".$row['drug_ID']."</td>
                <td>".$row['stock']."</td>
            </tr>";
    }

    echo "</table>";
} else {
    echo "No medicines found.";
}

$conn->close();

?>