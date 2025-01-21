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
            position: relative;
        }
        
        .delete-form label,
        .delete-form input,
        .delete-form button {
            display: block;
            margin-bottom: 10px;
        }
        
        .error-message {
            position: absolute;
            top: -35px;
            color: red;
            font-weight: bold;
        }
        
        .success-message {
            color: green;
            font-weight: bold;
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
        
            <label for="password">Password:</label>
            <input type="password" name="password" required>
        
            <label for="email">Email:</label>
            <input type="email" name="email" required>
        
            <button type="submit">Delete Account</button>
        </form>
        <div class="error-message">
            <?php
            if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])) {
                $username = $_POST['username'];
                $password = $_POST['password'];
                $email = $_POST['email'];

                // Create a database connection
                $servername = "localhost";
                $username_db = "root";
                $password_db = "";
                $dbname = "pharma_hub";

                $conn = new mysqli($servername, $username_db, $password_db, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Fetch hashed password from the database
                $sql = "SELECT password FROM patient_list WHERE username = '$username' AND email = '$email'";
                $result = $conn->query($sql);

                if ($result->num_rows === 1) {
                    $row = $result->fetch_assoc();
                    $hashedPassword = $row['password'];

                    // Verify the provided password with the hashed password
                    if (password_verify($password, $hashedPassword)) {
                        // Password matches, delete the account
                        $deleteQuery = "DELETE FROM patient_list WHERE username = '$username' AND email = '$email'";
                        if ($conn->query($deleteQuery) === TRUE) {
                            // Display success message at the top
                            echo "Account deleted successfully.";
                            echo "<script>document.querySelector('.success-message').style.display = 'block';</script>";
                        } else {
                            echo "Error deleting account: " . $conn->error;
                            echo "<script>document.querySelector('.error-message').style.display = 'block';</script>";
                        }
                    } else {
                        echo "Invalid password.";
                        echo "<script>document.querySelector('.error-message').style.display = 'block';</script>";
                    }
                } else {
                    echo "Username and email not found.";
                    echo "<script>document.querySelector('.error-message').style.display = 'block';</script>";
                }

                // Close the database connection
                $conn->close();
            }
            ?>
        </div>
        <div class="page-footer">
            <a href="home.php">Back to Home</a>
        </div>
    </div>
</body>
</html>
