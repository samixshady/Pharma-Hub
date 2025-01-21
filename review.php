<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'Pharma_Hub';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $comment = $_POST["comment"];
    $rating = $_POST["rating"];

    $sql = "INSERT INTO reviews (username, comment, rating) VALUES ('$username', '$comment', '$rating')";

    if ($conn->query($sql) === TRUE) {
        echo '<div class="success-msg">Review recorded successfully.</div>';
    } else {
        echo '<div class="error-msg">Error: ' . $sql . '<br>' . $conn->error . '</div>';
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer Reviews</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .sign-up-container {
            width: 400px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .signup-heading {
            text-align: center;
        }

        .row {
            margin-bottom: 10px;
        }

        .form-label {
            display: inline-block;
            width: 100px;
        }

        .input-box-330 {
            width: 330px;
        }

        .btn {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .page-footer {
            margin-top: 20px;
            text-align: center;
        }
		.back-to-home {
        margin-top: 20px;
        text-align: center;
    }

    .back-to-home .btn {
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: none; /* Remove the underline from the link */
    }

    .back-to-home .btn:hover {
        background-color: #0056b3;
    }
    </style>
    <script>
        function submitReview() {
            var username = document.getElementById("username").value;
            var comment = document.getElementById("comment").value;
            var rating = document.getElementById("rating").value;

            if (username && comment && rating) {
                document.getElementById("review-form").submit();
            } else {
                alert("Please fill in all fields.");
            }
        }
    </script>
</head>
<body>
    <div class="sign-up-container">
        <h1 class="signup-heading">Customer Reviews</h1>
        <form id="review-form" method="post" action="">
            <div class="row">
                <div class="form-label inline-block">Username:</div>
                <input type="text" name="username" id="username" class="input-box-330">
            </div>
            <div class="row">
                <div class="form-label inline-block">Comment:</div>
                <textarea name="comment" id="comment" class="input-box-330"></textarea>
            </div>
            <div class="row">
                <div class="form-label inline-block">Rating:</div>
                <select name="rating" id="rating" class="input-box-330">
                    <option value="5">5 Stars</option>
                    <option value="4">4 Stars</option>
                    <option value="3">3 Stars</option>
                    <option value="2">2 Stars</option>
                    <option value="1">1 Star</option>
                </select>
            </div>
            <div class="row">
                <input type="button" value="Submit Review" onclick="submitReview()" class="btn">
            </div>
        </form>
        <div class="page-footer">
            <div class="back-to-home">
    <a class="btn" href="home.php">Back to Home</a>
</div>

</div>

        </div>
    </div>
<style>
body {
  background-image: url("images/review.gif");
  background-color: #cccccc;
  background-repeat: no-repeat;
  background-size: cover; /* This ensures the image covers the entire background */
}
</style>
	
</body>
</html>
