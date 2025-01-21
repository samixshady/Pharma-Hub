<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <style>
        body {
            background-image: url("images/admin.gif");
            background-color: #cccccc;
            background-repeat: no-repeat;
            background-size: 116%;
        }
        .login-container {
            width: 300px;
            margin: auto;
            margin-top: 100px;
            background-color: rgba(255, 255, 255, 0.7);
            padding: 20px;
            border-radius: 5px;
            text-align: center;
        }
        .login-input {
            width: 90%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        .login-submit {
            width: 90%;
            background-color: #3498db;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 3px;
            cursor: pointer;
        }
        .login-submit:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Administrator Login</h2>
        <form action="" method="post" onsubmit="return loginValidation()">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" class="login-input" required><br>
            <label for="password">Password:</label>
            <input type="password" name="password" id="login-password" class="login-input" required><br>
            <input type="submit" value="Login" class="login-submit">
        </form>
        <div>
            <br></br>
            <a href="login.php">User Login</a>
        </div>
        <?php
        session_start();

        // Replace with your actual database connection details
        $hostname = 'localhost';
        $dbUsername = 'root';
        $dbPassword = '';
        $database = 'pharma_hub';

        $conn = new mysqli($hostname, $dbUsername, $dbPassword, $database);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if (!empty($_POST["username"]) && !empty($_POST["password"])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Sanitize inputs before using them in SQL queries
            $username = $conn->real_escape_string($username);

            $query = "SELECT * FROM admins WHERE username = '$username'";
            $result = $conn->query($query);

            if ($result->num_rows === 1) {
                $row = $result->fetch_assoc();
                $dbPassword = $row['password'];

                // Compare the provided password with the one stored in the database
                if ($password === $dbPassword) {
                    $_SESSION['username'] = $username;
                    header("Location: adminhome.php");
                    exit();
                } else {
                    echo "<p class='error-msg'>Wrong password.</p>";
                }
            } else {
                echo "<p class='error-msg'>Username not found.</p>";
            }
        }

        $conn->close();
        ?>
    </div>
    <div class="phppot-container">
        <!-- Rest of the content goes here -->
    </div>

    <script src="vendor/jquery/jquery-3.3.1.js" type="text/javascript"></script>
    <script>
        function loginValidation() {
            var valid = true;
            $("#username").removeClass("error-field");
            $("#login-password").removeClass("error-field");

            var UserName = $("#username").val();
            var Password = $('#login-password').val();

            if (UserName.trim() == "") {
                valid = false;
                $("#username").addClass("error-field");
            }
            if (Password.trim() == "") {
                valid = false;
                $("#login-password").addClass("error-field");
            }

            if (!valid) {
                $('.error-field').first().focus();
            }
            return valid;
        }
    </script>
</body>
</html>
