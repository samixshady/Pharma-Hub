<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pharma_hub";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve pharmacies from the database
$sql = "SELECT * FROM pharmacy";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h1>Pharmacies</h1>";
    echo "<table border='1'>
            <tr>
                <th>store_ID</th>
                <th>Pharmacy Name</th>
                <th>Phone Number</th>
                <th>Location</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".$row['store_ID']."</td>
                <td>".$row['name']."</td>
                <td>".$row['phone_number']."</td>
                <td>".$row['location']."</td>
            </tr>";
    }

    echo "</table>";
} else {
    echo "No medicines found.";
}

$conn->close();
?>
