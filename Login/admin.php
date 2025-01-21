<?php
use Phppot\Member;

if (! empty($_POST["login-btn"])) {
    require_once __DIR__ . '/Model/Member.php';
    $member = new Member();
    $loginResult = $member->loginMember();
} elseif (! empty($_POST["signup-btn"])) {
    require_once __DIR__ . '/Model/Member.php';
    $member = new Member();
    $signupResult = $member->registerMember();
}
?>
<HTML>
<HEAD>
<TITLE>PHARMA-HUB</TITLE>
<link href="assets/css/phppot-style.css" type="text/css"
	rel="stylesheet" />
<link href="assets/css/user-registration.css" type="text/css"
	rel="stylesheet" />
<script src="vendor/jquery/jquery-3.3.1.js" type="text/javascript"></script>
</HEAD>
<BODY>
	<div class="phppot-container">
		<div class="sign-up-container">
			<div class="login-signup">
				<br>
				<a href="login.php">User Login</a>
			</div>
			<div class="signup-align">
				<!-- Sign-up form -->
				<form name="signup" action="" method="post" onsubmit="return signupValidation()">
					<div class="signup-heading" style="text-align: center;">
						<span style="background-color: #3498db; color: #fff; padding: 5px 10px; border-radius: 5px;">Admin Only</span> <br>
						</br> Login
					</div>
					<?php if(!empty($signupResult)){?>
					<div class="success-msg"><?php echo $signupResult;?></div>
					<?php }?>
					<div class="row">
						<div class="inline-block">
							<div class="form-label">
								Admin Username<span class="required error" id="signup-username-info"></span>
							</div>
							<input class="input-box-330" type="text" name="signup-username"
								id="signup-username">
						</div>
					</div>
					<div class="row">
						<div class="inline-block">
							<div class="form-label">
								Admin Password<span class="required error" id="signup-password-info"></span>
							</div>
							<input class="input-box-330" type="password"
								name="signup-password" id="signup-password">
						</div>
					</div>
					<div class="row">
						<input class="btn" type="submit" name="signup-btn"
							id="signup-btn" value="Sign Up">
					</div>
				</form>
			</div>
		</div>
	</div>

	<script>
	function loginValidation() {
		var valid = true;
		$("#username").removeClass("error-field");
		$("#login-password").removeClass("error-field");

		var UserName = $("#username").val();
		var Password = $('#login-password').val();

		$("#username-info").html("").hide();

		if (UserName.trim() == "") {
			$("#username-info").html("required.").css("color", "#ee0000").show();
			$("#username").addClass("error-field");
			valid = false;
		}
		if (Password.trim() == "") {
			$("#login-password-info").html("required.").css("color", "#ee0000").show();
			$("#login-password").addClass("error-field");
			valid = false;
		}
		if (valid == false) {
			$('.error-field').first().focus();
			valid = false;
		}
		return valid;
	}
	</script>
</BODY>
</HTML>
<!DOCTYPE html>
<html>
<head>
<style>
body  {
  background-image: url("images/admin.gif");
  background-color: #cccccc;
}
</style>
</head>
</html>