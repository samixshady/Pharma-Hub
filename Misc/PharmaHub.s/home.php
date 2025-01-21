<?php
session_start();
if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
    session_write_close();
} else {
    // since the username is not set in session, the user is not-logged-in
    // he is trying to access this page unauthorized
    // so let's clear all session variables and redirect him to index
    session_unset();
    session_write_close();
    $url = "./index.php";
    header("Location: $url");
}

?>
<HTML>
<HEAD>
<TITLE>Welcome</TITLE>
<link href="assets/css/phppot-style.css" type="text/css"
    rel="stylesheet" />
<link href="assets/css/user-registration.css" type="text/css"
    rel="stylesheet" />
</HEAD>
<BODY>
    <div class="phppot-container">
        <div class="page-header">
            <span class="login-signup">
                <a href="user.php">BIO</a> | 
                <a href="review.php">Reviews</a> | 
                <a href="checkreviews.php">View Reviews</a>	|			
                <a href="logout.php">Logout</a>
				<br></br>
                <a href="deleteuser.php">Delete Account</a>
            </span>
        </div>
        <div class="page-content">Welcome <?php echo $username;?></div>
    </div>
<style>
body {
  background-image: url("images/home.jpeg");
  background-color: #cccccc;
  background-repeat: no-repeat;
  background-size: cover; /* This ensures the image covers the entire background */
}
</style>	
</BODY>
</HTML>
