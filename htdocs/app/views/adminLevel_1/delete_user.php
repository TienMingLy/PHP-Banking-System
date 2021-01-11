<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/adminLevel_1/delete_user.css">
		<title>User Delete</title>
	</head>

	<body>
		<div id ="editUserPasswordDiv">
			<form action='' method='post' id="edit_user_password">

				<img src="../../../images/admin.png" alt="Admin logo" id ="adminLogo">
				<h2 id="accountH2">Account's username: <?php echo $_SESSION['user_username'];?></h2>		
				<br/>
				<input type="submit" name="action" value="Delete" id="deleteButton"></input>	
				<br/>
				<a href="listAllUser1">Back</input></a>
			</form>
		</div>

	</body>
	
</html>
