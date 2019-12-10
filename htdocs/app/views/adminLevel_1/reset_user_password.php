<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/adminLevel_1/reset_user_password.css">
		<title>Reset User's Password Page</title>
	</head>
	
	<body>
		<div id="resetUserPasswordDiv">
			<form action='' method='post' id="reset_password_Form">
				<br/>
				<img src="../../images/TheBank_Logo_Transparent.png" id="theBankLogoImg" alt="The Bank Logo">
				<br/><br/>
				<label id="resetPasswordLabel">Reset Password Form</label>
				<br/>
				<label id="usernameLabel">Username<input type="text" id="usernameInput" name='username' value="<?php echo $_SESSION['client_username']?>" readonly/></label>
				<br/>
				<label id="passwordLabel">Password<input type='password' id='passwordInput' placeholder='Enter new password' name='password_hash' required/></label>
				<br/>
				<label><input type='password' id="passwordAgainInput" placeholder="Enter new password again" name='password_confirm' required/></label>

				<input type='submit' name='action' value='Save' id="saveButton"/>
				<br/><br/>
				<a href="listAllUser1"><h2>Back</h2></a>
			</form>
		</div>
	</body>
</html>