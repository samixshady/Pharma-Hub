<!DOCTYPE html>
<html>
<head>
    <title>Pharma Hub</title>
</head>
<body>
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

    // Get data from the form
    $medicineName = $_POST['medicine_name'];
    $companyName = $_POST['company_name'];
    $companyLocation = $_POST['company_location'];
    $stock = $_POST['stock'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Insert data into the database
    $sql = "INSERT INTO medicines (medicine_name, company_name, company_location, stock, price, description) VALUES ('$medicineName', '$companyName', '$companyLocation', $stock, $price, '$description')";

    if ($conn->query($sql) === TRUE) {
        echo "Medicine added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    ?>

    <button onclick="window.location.href='adminhome.php'">Admin Panel</button>
</body>
</html>
