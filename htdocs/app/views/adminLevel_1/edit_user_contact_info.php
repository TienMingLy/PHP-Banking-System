<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/adminLevel_1/edit_user_contact_info.css">
		<title>Edit Info Page</title>
	</head>
	
	<body>
		<div id="editInfoDiv">

			<form action='' method='post' id="registerContactInfoForm">
			<?php								
				foreach($data['userInfos'] as $user)
				{
			?>
					<br/>
					<img src="../../images/TheBank_Logo_Transparent.png" id="theBankLogoImg" alt="The Bank Logo">
					<br/><br/>
					<label id="personalContactInfoLabel"><?php echo $_SESSION['client_username']?>'s Contact Information</label>
					<br/>
					<label id="typeLabel">Type<input type="text" id="typeInput"placeholder="Enter type" name='type' value="<?php echo $user['Type']?>" required/></label>
					<br/>
					<label id="infoLabel">Info<input type='text' id="infoInput" placeholder="Enter info" name='info' value='<?php echo $user['Info'] ?>' required/></label>
					<br/>	

					<input type='submit' name='action' value='Save' id="saveButton"/>
			<?php				
				}
			?>
			<a href="listAllUser1"><h2>Back to Users</h2></a>	
			</form>
		</div>
	</body>
</html>

