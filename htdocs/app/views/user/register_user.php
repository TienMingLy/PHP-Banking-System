<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/user/register_user.css">
		<title>Register Page</title>
	</head>
	
	<body>
		<div id="registerDiv">
			<form action='' method='post' id="registerForm">
				<br/>
				<img src="../../images/TheBank_Logo_Transparent.png" id="theBankLogoImg" alt="The Bank Logo">
				<label id="usernameLabel"><b>Username</b><input type="text" id="usernameInput"placeholder="Enter username" name='username' required/></input></label>
				<br/>
				<label id="passwordLabel"><b>Password</b><input type='password' id="passwordInput" placeholder="Enter password" name='password_hash' required/></input></label>
				<br/>
				<label><input type='password' id="passwordAgainInput" placeholder="Enter password again" name='password_confirm' required/></input></label>
				<input type='submit' name='action' value='Register' id="signUpButton"/>
				<br/><br/>
				<p id="alreadyRegisteredP">Already registered? <a href="login"><b>Login Here</b></p>
			</form>
		</div>
	</body>
</html>