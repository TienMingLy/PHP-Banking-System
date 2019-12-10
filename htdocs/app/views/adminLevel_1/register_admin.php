<html>
	<head>
		<script src="https://kit.fontawesome.com/eaa91d4b4b.js" crossorigin="anonymous"></script>
		<link rel="stylesheet" type="text/css" href="../css/adminLevel_1/register_admin.css">
		<title>Admin Registration Page</title>
	</head>
	
	<body>
		<div id="adminRegisterDiv">
			<form action='' method='post' id="adminLevelOneRegisterForm">
				<br/>
				<img src="../images/addAdmin.png" id="adminLogo" alt="Admin logo" width="250px" height="250px">
				<br/>
				<h2 id="registerAdminH2">Register a new Administator</h2>
				<br/>
				<label id="usernameLabel"><b>Username</b><input type="text" id="usernameInput"placeholder="Enter username" name='username' required/></label>
				
				<label id="passwordLabel"><b>Password</b><input type='password' id="passwordInput" placeholder="Enter password" name='password_hash' required/></label>

				<label><input type='password' id="passwordAgainInput" placeholder="Enter password again" name='password_confirm' required/></label>				

				<label id="privilegedLabel"><b>Privileged Level</b>
				<select name="privileged_level_Option" id="privilegedSelectBox" required>
						<option disabled selected value> -- Select a Privileged Level -- </option>
						<option value="1">1 => Full Control</option>
						<option value="2">2 => Limited Control</option>
						<option value="3">3 => Only for viewing</option>					
				</select></label>

				<input type='submit' name='action' value='Register' id="registerButton"/>
				<br/><br/>
			</form>
			<a href = "index"><h4 id ="toGoback">Back to Index</h4></a>
		</div>


		

	</body>
</html>