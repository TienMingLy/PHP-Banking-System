<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/adminLevel_1/edit_user_account_status.css">
		<title>Account Status Page</title>
	</head>

	<body>
		<div id ="editUserAccountStatusDiv">
			<form action='' method='post' id="edit_user_account_status_form">
				<img src="../../../images/admin.png" alt="Admin logo" id ="adminLogo">
				<h2 id="accountH2">Username: <?php echo $_SESSION['client_username'];?></h2>		

			<?php 
				//If it is Active
				if($_SESSION['active'] == 1)
				{
			?>
					<input type="submit" name="action" value="Deactivate" id="actionButton"></input>	
			<?php 
				}
				
				//If it is Deactivated
				else
				{
			?>		
					<input type="submit" name="action" value="Reactivate" id="actionButton"></input>
			<?php			
				}
			?>
					
				<br/><br/>
				<a href="/../admin/listAllUser1"><h2>Back to Users</h2></a>	
			</form>
		</div>

	</body>
	
</html>
