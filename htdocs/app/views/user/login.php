<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/user/login.css">
		<title>Login Page</title>

	</head>

	<body>
			<div id=loginDiv>
				<form action="" method="post" id="loginForm">
					<br/>
					<img src="../../images/TheBank_Logo_Transparent.png" id="theBankLogoImg" alt="The Bank Logo">
					<label id="usernameLabel"><b>Username</b></label>
					<input type="text" placeholder="Enter Username" name="username" id="usernameInput" required>
					<br/>
					<label id="passwordLabel" for="psw"><b>Password</b></label>
					<input type="password" placeholder="Enter Password" name="password_hash" id="passwordInput" required>
					<br/><br/>	
					<input type="submit" name="action" value="Sign In" id="signInButton"></input>
					<br/><br/>	
					<p id="notAnUserP">Not an user? <a href="register"><b>Register Here</b></p>
					<a href=""><p id="forgotPasswordP">Forgot your password?</p></a>
				</form>
			</div>		
	</body>
</html>