<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/user/change_user_password.css">
		<title>Change User Password</title>
	</head>
	
	<body>
		<div id="resetUserPasswordDiv">
			<form action='' method='post' id="reset_password_Form">
				<br/>
				<img src="../../images/TheBank_Logo_Transparent.png" id="theBankLogoImg" alt="The Bank Logo">
				<br/><br/>
				<label id="resetPasswordLabel">Change Password</label>
				<br/>
				<label id="usernameLabel">Username<input type="text" id="usernameInput" name='username' value="<?php echo $_SESSION['username']?>" readonly/></label>
				<br/>
				<label id="oldPasswordLabel">Old Password<input type='password' id='oldPasswordInput' placeholder='Enter your old password' name='old_password_hash' required/></label>
				<br/>
				<label id="newPasswordLabel">New Password<input type='password' id='newPasswordInput' placeholder='Enter your new password' name='new_password_hash' required/></label>
				<br/>
				<input type='password' id="newPasswordAgainInput" placeholder="Enter new password again" name='new_password_confirm' required/>
				<br/>
				<input type='submit' name='action' value='Save' id="saveButton"/>
				<br/><br/>
				<a href="/../home/index"><h2>Back to Index</h2></a>	
			</form>
		</div>
	</body>
</html>