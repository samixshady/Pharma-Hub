<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Pharma_Hub";

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

        .back-to-home {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .back-to-home .btn {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .back-to-home .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="phppot-container">
        <div class="back-to-home">
            <a class="btn" href="home.php">Back to Home</a>
        </div>
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



