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

// Retrieve medicines from the database
$sql = "SELECT * FROM medicines";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h1>List of Medicines</h1>";
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Medicine Name</th>
                <th>Company Name</th>
                <th>Company Location</th>
                <th>Stock</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".$row['id']."</td>
                <td>".$row['medicine_name']."</td>
                <td>".$row['company_name']."</td>
                <td>".$row['company_location']."</td>
                <td>".$row['stock']."</td>
            </tr>";
    }

    echo "</table>";
} else {
    echo "No medicines found.";
}

$conn->close();
?>
