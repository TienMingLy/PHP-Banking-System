<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/user/register_user_info.css">
		<title>Register Info Page</title>
	</head>
	
	<body>
		<div id="registerInfoDiv">

			<form action='' method='post' id="registerInfoForm">
				<br/>
				<img src="../../images/TheBank_Logo_Transparent.png" id="theBankLogoImg" alt="The Bank Logo">
				<br/><br/>
				<label id="personalInfoLabel">Your Personal Information</label>
				<br/>
				<label id="firstNameLabel">First Name<input type="text" id="firstnameInput"placeholder="Enter firstname" name='firstname' required/></label>
				<br/>
				<label id="lastNameLabel">Last Name<input type='text' id="lastnameInput" placeholder="Enter lastname" name='lastname' required/></label>
				<br/>
				<label id="streetAddressLabel">Street Address<input type='text' id="streetAddressInput" placeholder="Enter street address" name='street_address' required/></label>
				<br/>
				<label id="cityLabel">City<input type='text' id="cityInput" placeholder="Enter city" name='city' required/></label>
				<br/>
				<label id="provinceLabel">Province<input type='text' id="provinceInput" placeholder="Enter province" name='province' required/></label>
				<br/>
				<label id="zipcodeLabel">Zipcode<input type='text' id="zipcodeInput" placeholder="Enter zipcode" name='zipcode' required/></label>
				<br/>	
				<?php
					if(isset($_SESSION['account_active']))
					{
				?>
					<input type='submit' name='action' value='Add' id="nextButton"/>
				<?php
					}
					else
					{
				?>
					<input type='submit' name='action' value='Next' id="nextButton"/>
				<?php
					}
				?>
			</form>
		</div>
	</body>
</html>

