<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/adminLevel_1/index.css">
		<title>Admin Level 1 Page</title>
	</head>	
	
	<body>
		<div id ="adminLevelOneDiv">
			<img src="../../../images/admin.png" alt="Admin logo" id ="adminLogo">
			<h2 id="welcomeBackH2">Welcome back <?php echo $_SESSION['username'];?>!</h2>		

			<a href="/admin/listAllUser1"><input type="submit" name="action" value="List of User" id="listUserButton"></input></a>
			<a href="/admin/listAllAdmin1"><input type="submit" name="action" value="List of Admin" id="listAdminButton"></input></a>
			<br/><br/>
			<a href="/admin/registerAdmin"><input type="submit" name="action" value="Register Admin" id="registerAdminButton"></input></a>
			<br/>
			<a href="/admin/logout"><input type="submit" name="action" value="Sign Out" id="logoutButton"></input></a>
		</div>
	</body>
</html>