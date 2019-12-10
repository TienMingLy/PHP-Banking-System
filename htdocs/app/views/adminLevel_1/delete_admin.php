<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/adminLevel_1/delete_admin.css">
		<title>Admin Password Reset</title>
	</head>

	<body>
		<div id ="editAdminPasswordDiv">
			<form action='' method='post' id="edit_admin_password">

				<img src="../../../images/admin.png" alt="Admin logo" id ="adminLogo">
				<h2 id="accountH2">Account's username: <?php echo $_SESSION['admin_username'];?></h2>		
				<br/>
				<input type="submit" name="action" value="Delete" id="deleteButton"></input>	
				<br/>
				<a href="listAllAdmin1"><input type="submit" value="Back" id="cancelButton"></input></a>
			</form>
		</div>

	</body>
	
</html>
