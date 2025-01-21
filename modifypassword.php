<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Modify Password</h2>
        <form action="modifypassword.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br>

            <label for="old_password">Old Password:</label>
            <input type="password" id="old_password" name="old_password" required><br>

            <label for="new_password">New Password:</label>
            <input type="password" id="new_password" name="new_password" required><br>

            <input type="submit" value="Change Password">
			<br> </br>
			<br> </br>
			<div class="page-footer">
            <a href="home.php" class="back-to-home-button">Back to Home</a>
        </form>
    </div>
</body>
</html>

<style>
    .container {
        width: 300px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
		background-color: #ffffff;
        border-radius: 5px;
        text-align: center;
    }

    input[type="text"], input[type="password"] {
        width: 90%;
        padding: 8px;
        margin: 5px 0;
        border: 1px solid #ccc;
        border-radius: 3px;
    }
    .back-to-home-button {
        display: inline-block;
        margin-top: 10px;
        padding: 5px 10px;
        background-color: #428bca;
        color: white;
        text-decoration: none;
        border-radius: 3px;
    }

    .back-to-home-button:hover {
        background-color: #3071a9;
    }
    body  {
    background-image: url("images/changepass.jpg");
    background-color: #cccccc;
    background-repeat: no-repeat;
    background-size: cover; /* This ensures the image covers the entire background */
}	
</style>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $oldPassword = $_POST["old_password"];
    $newPassword = $_POST["new_password"];

    // Connect to the database
    $conn = new mysqli("localhost", "root", "", "pharma_hub");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch the stored hashed password
    $query = "SELECT password FROM patient_list WHERE username = '$username'";
    $result = $conn->query($query);
    
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $storedPassword = $row["password"];

        // Verify the old password
        if (password_verify($oldPassword, $storedPassword)) {
            // Hash the new password
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            // Update the password in the database
            $updateQuery = "UPDATE patient_list SET password = '$hashedPassword' WHERE username = '$username'";
            
            if ($conn->query($updateQuery) === TRUE) {
                echo "Password updated successfully.";
            } else {
                echo "Error updating password: " . $conn->error;
            }
        } else {
            echo "Incorrect old password.";
        }
    } else {
        echo "User not found.";
    }

    $conn->close();
}
?>
