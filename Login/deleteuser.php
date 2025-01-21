<?php
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

if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])) {
    $username = $_POST['username'];
    /* $password = $_POST['password']; */
    $email = $_POST['email'];
    
    // Sanitize inputs to prevent SQL injection
    $username = $conn->real_escape_string($username);
    /* $password = $conn->real_escape_string($password); */
    $email = $conn->real_escape_string($email);
    
    // Check if username, password, and email match
    $query = "SELECT * FROM patient_list WHERE username = '$username' AND email = '$email'";
    $result = $conn->query($query);
    
    if($result->num_rows > 0) {
        // Username, password, and email match, proceed to delete account
        $deleteQuery = "DELETE FROM patient_list WHERE username = '$username' AND email = '$email'";
        if ($conn->query($deleteQuery) === TRUE) {
            echo "Account deleted successfully.";
        } else {
            echo "Error deleting account: " . $conn->error;
        }
    } else {
        echo "Invalid username, or email.";
    }
}

// Close connection <label for="password">Password:</label>
        //<input type="password" name="password" required><br>
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete Account</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        
        .delete-form {
            width: 300px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        .delete-form label,
        .delete-form input,
        .delete-form button {
            display: block;
            margin-bottom: 10px;
        }
        
        .page-footer {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="delete-form">
        <h2>Delete Account</h2>
        <form method="POST" action="">
            <label for="username">Username:</label>
            <input type="text" name="username" required>
        
            <label for="email">Email:</label>
            <input type="email" name="email" required>
        
            <button type="submit">Delete Account</button>
        </form>
        <div class="page-footer">
            <a href="home.php">Back to Home</a>
        </div>
    </div>
<style>
body {
  background-image: url("images/delete.jpeg");
  background-color: #cccccc;
  background-repeat: no-repeat;
  background-size: cover; /* This ensures the image covers the entire background */
}
</style>	
</body>
</html>

