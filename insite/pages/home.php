<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>BlogApp</title>
	<?php require('../common/common-resources.php'); ?>
	<link rel="stylesheet" type="text/css" href="../styles/home.css" />
	<script type="text/javascript" src="../scripts/home.js"></script>
	<script type="text/javascript" src="../scripts/common.js"></script>
</head>
<body>
	<div class="main-container">

		<?php require('../common/header.php'); ?>

		<!-- Start of div to display all the blog -->
		<div id="all-blog"></div>
		
		<!-- Start of div to display all the blog -->
		<div id="myModal" class="overlay-container">
			<div class="login-container">
				<span class="close">&times;</span>
				<div class="login-wrap">
					<div class="login-heading">
						<div class="__text">LOGIN
						</div>
					</div>
					<div class="login-body">
						<div class="email login-element">
							<label for="email-id">Email Id</label>
							<input type="email" id="email-id">
						</div>
						<div class="password login-element">
							<label for="password">Password</label>
							<input type="password" id="password">
						</div>
						<div class="error-message" id="login-error">		
						</div>
						<div class="submit-action login-action" id="login-submit">LOGIN</div>
						<div id="registration-form-div">
							Not a member yet? 
							<span id="sign-up-button" class="submit-action">
								Sign up Now!
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="myModal-registration" class="overlay-container">
			<div class="login-container">
				<span class="close">&times;</span>
				<form class="login-wrap" action="../pages/registration.php" method="post">
					<div class="login-heading">
						<div class="__text">
							REGISTRATION
						</div>
					</div>
					<div class="login-body">
						<div class="email login-element">
							<label for="email-id">Email Id</label>
							<input type="email" name="email">
						</div>
						<div class="email login-element">
							<label for="registration-username">User Name</label>
							<input type="text" name="username">
						</div>
						<div class="password login-element">
							<label for="password">Password</label>
							<input type="password" name="password">
						</div>
						<div class="password login-element">
							<label for="password">Confirm Password</label>
							<input type="password" id="reg-confirm-password">
						</div>
						<input type="submit" class="submit-action login-action" id="register-button" value = 'Register'/>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
