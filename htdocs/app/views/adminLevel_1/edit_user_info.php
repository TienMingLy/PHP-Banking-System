<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/adminLevel_1/edit_user_info.css">
		<title>Edit Info Page</title>
	</head>
	
	<body>
		<div id="editInfoDiv">
			<form action='' method='post' id="editInfoForm">
			<?php								
				foreach($data['userInfos'] as $user)
				{
			?>
					<br/>
					<img src="../../images/TheBank_Logo_Transparent.png" id="theBankLogoImg" alt="The Bank Logo">
					<br/><br/>
					<label id="personalInfoLabel"><?php echo $_SESSION['client_username']?>'s Personal Information</label>
					<br/>
					<label id="firstNameLabel">First Name<input type="text" id="firstnameInput"placeholder="Enter firstname" name='firstname' value="<?php echo $user['FirstName']?>" required/></label>
					<br/>
					<label id="lastNameLabel">Last Name<input type='text' id="lastnameInput" placeholder="Enter lastname" name='lastname' value='<?php echo $user['LastName'] ?>' required/></label>
					<br/>
					<label id="streetAddressLabel">Street Address<input type='text' id="streetAddressInput" placeholder="Enter street address" name='street_address' value='<?php echo $user['Street_Address']?>' required/></label>
					<br/>
					<label id="cityLabel">City<input type='text' id="cityInput" placeholder="Enter city" name='city' value='<?php echo $user['City'] ?>' required/></label>
					<br/>
					<label id="provinceLabel">Province<input type='text' id="provinceInput" placeholder="Enter province" name='province' value='<?php echo $user['Province']?>' required/></label>
					<br/>
					<label id="zipcodeLabel">Zipcode<input type='text' id="zipcodeInput" placeholder="Enter zipcode" name='zipcode' value='<?php echo $user['Zipcode']?>' required/></label>
					<br/>	

					<input type='submit' name='action' value='Save' id="nextButton"/>
			<?php				
				}
			?>
			<a href="listAllUser1"><h2>Back to Users</h2></a>	
			</form>
		</div>
	</body>
</html>

