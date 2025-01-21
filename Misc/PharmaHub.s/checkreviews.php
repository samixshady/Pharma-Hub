<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch reviews from the reviews table
$sql = "SELECT username, comment, rating FROM reviews";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reviews</title>
    <link href="assets/css/phppot-style.css" type="text/css" rel="stylesheet" />
    <style>
        .review-box {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="phppot-container">
        <div class="page-header">
            <h2>Reviews</h2>
        </div>
        <div class="page-content">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $username = $row["username"];
                    $comment = $row["comment"];
                    $rating = $row["rating"];
                    
                    echo "<div class='review-box'>";
                    echo "<strong>Username:</strong> $username<br>";
                    echo "<strong>Rating:</strong> $rating<br>";
                    echo "<strong>Comment:</strong> $comment<br>";
                    echo "</div>";
                }
            } else {
                echo "No reviews available.";
            }
            
            // Close the database connection
            $conn->close();
            ?>
        </div>
        <div class="page-footer">
            <a href="home.php">Back to Home</a>
        </div>
    </div>
<style>
body {
  background-image: url("images/checkreviews.gif");
  background-color: #cccccc;
  background-repeat: no-repeat;
  background-size: cover; /* This ensures the image covers the entire background */
}
</style>
</body>
</html>



