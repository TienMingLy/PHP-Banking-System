<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/user/edit_user_account_status.css">
		<?php include('userNavbar.php')?>
		<title>Account Status Page</title>
	</head>

	<body>
		<div id ="editUserAccountStatusDiv">
			<form action='' method='post' id="edit_user_account_status">

				<img src="../../../images/admin.png" alt="Admin logo" id ="adminLogo">
				<h2 id="accountH2">Account's username: <?php echo $_SESSION['username'];?></h2>		
				<input type="submit"   name="action" value="Deactivate" id="submitButton"></input>	
				<br/><br/>
				<a href="index">Back to Index</a>
			</form>
		</div>

	</body>
	
</html>
