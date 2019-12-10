<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/user/register_user_contact_info.css">
		<title>Register Contact Info Page</title>
	</head>
	
	<body>
		<div id="registerContactInfoDiv">

			<form action='' method='post' id="registerContactInfoForm">
				<br/>
				<img src="../../images/TheBank_Logo_Transparent.png" id="theBankLogoImg" alt="The Bank Logo">
				<br/><br/>
				<label id="personalContactInfoLabel">Your Contact Information</label>
				<br/>
				<label id="typeLabel">Type<input type="text" id="TypeInput"placeholder="Enter contact type" name='type' required/></label>
				<br/>
				<label id="infoLabel">Info<input type='text' id="infoInput" placeholder="Enter info" name='info' required/></label>
				<br/>
				<input type='submit' name='action' value='Next' id="nextButton"/>
			</form>
		</div>
	</body>
</html>

