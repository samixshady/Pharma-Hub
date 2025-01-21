<?php
// Add your PHP code for handling form submissions and database insertion here
error_reporting(E_ALL);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pharma_hub";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $name = $_POST["signup-name"];
    $phone = $_POST["signup-phone"];
    $email = $_POST["signup-email"];
    $age = $_POST["signup-age"];
    $address = $_POST["signup-address"];

    // Generating a unique user ID
    $userID = uniqid();
	
    $sql = "SELECT user_id FROM user ORDER BY user_id DESC LIMIT 1";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$latestUserID = $row["user_id"];

    
		$latestCounter = (int)substr($latestUserID, 1);
    
    
		$counter = $latestCounter + 1;
	} else {
  
		$counter = 1;
	}


	function generateUserID($counter) {
		return 'u' . sprintf('%03d', $counter);
	}

	//$counter++;


	$userID = generateUserID($counter);


    $sql = "INSERT INTO user (user_id, user_name, address, phone, age, email)
            VALUES ('$userID', '$name', '$address', '$phone', '$age', '$email')";

    if ($conn->query($sql) === TRUE) {
        $signupResult = "Your information has been stored successfully. Your user ID is: $userID";
    } else {
        $signupResult = "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>PHARMACY HUB - User Information</title>
    <link href="assets/css/phppot-style.css" type="text/css" rel="stylesheet" />
    <link href="assets/css/user-registration.css" type="text/css" rel="stylesheet" />
    <script src="vendor/jquery/jquery-3.3.1.js" type="text/javascript"></script>
</head>
<body>
    <div class="phppot-container">
        <div class="sign-up-container">
            <div class="login-signup">
                <br>
                
            </div>
            <div class="signup-align">
                <!-- User registration form -->
                <form name="userinfo" action="user.php" method="post" onsubmit="return signupValidation()">
                    <div class="signup-heading" style="text-align: center;">
                        User Information
                    </div>
                    <?php if(!empty($signupResult)){?>
                    <div class="success-msg"><?php echo $signupResult;?></div>
                    <?php }?>
                    <div class="row">
                        <div class="inline-block">
                            <div class="form-label">
                                Name<span class="required error" id="signup-name-info"></span>
                            </div>
                            <input class="input-box-330" type="text" name="signup-name" id="signup-name">
                        </div>
                    </div>
                    <div class="row">
                        <div class="inline-block">
                            <div class="form-label">
                                Phone Number<span class="required error" id="signup-phone-info"></span>
                            </div>
                            <input class="input-box-330" type="tel" name="signup-phone" id="signup-phone">
                        </div>
                    </div>
                    <div class="row">
                        <div class="inline-block">
                            <div class="form-label">
                                Email<span class="required error" id="signup-email-info"></span>
                            </div>
                            <input class="input-box-330" type="email" name="signup-email" id="signup-email">
                        </div>
                    </div>
                    <div class="row">
                        <div class="inline-block">
                            <div class="form-label">
                                Age<span class="required error" id="signup-age-info"></span>
                            </div>
                            <input class="input-box-330" type="number" name="signup-age" id="signup-age">
                        </div>
                    </div>
                    <div class="row">
                        <div class="inline-block">
                            <div class="form-label">
                                Address<span class="required error" id="signup-address-info"></span>
                            </div>
                            <textarea class="input-box-330" name="signup-address" id="signup-address"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <input class="btn" type="submit" name="signup-btn" id="signup-btn" value="Save my details">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    function signupValidation() {
        var valid = true;
        $("#signup-name").removeClass("error-field");
        $("#signup-phone").removeClass("error-field");
        $("#signup-email").removeClass("error-field");
        $("#signup-age").removeClass("error-field");
        $("#signup-address").removeClass("error-field");

        var Name = $("#signup-name").val();
        var Phone = $("#signup-phone").val();
        var Email = $("#signup-email").val();
        var Age = $("#signup-age").val();
        var Address = $("#signup-address").val();

        // Add validation checks similar to the loginValidation function for other fields
        if (Name.trim() === "") {
            valid = false;
            $("#signup-name-info").html("Name is required.").show();
        }
        if (Phone.trim() === "") {
            valid = false;
            $("#signup-phone-info").html("Phone number is required.").show();
        }
        if (Email.trim() === "") {
            valid = false;
            $("#signup-email-info").html("Email is required.").show();
        }
        if (Age.trim() === "") {
            valid = false;
            $("#signup-age-info").html("Age is required.").show();
        }
        if (Address.trim() === "") {
            valid = false;
            $("#signup-address-info").html("Address is required.").show();
        }
        if (valid == false) {
            $('.error-field').first().focus();
            valid = false;
        }
        return valid;
    }
    </script>
	   
</body>
</html>
<!DOCTYPE html>
<html>
<head>
<style>
body  {
  background-image: url("images/user_2.png");
  background-color: #cccccc;
}
</style>
</head>
</html>