<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/adminLevel_3/list_info.css">
		<title>Info Page</title>
	</head>

	<body>
		<div id="userListDiv">
			<table width="600" border="1" cellpadding="1" cellspacing="1" id="userTable">
				<tr>
					<th colspan="8"><h2><?php echo $_SESSION['client_username']?>'s Info Table</h2></th>
				</tr>

				<t>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Street Address</th>
					<th>City</th>
					<th>Province</th>
					<th>Zipcode</th>
				</t>

				<?php
					foreach($data['userInfos'] as $user)
					{
				?>
						<tr>
							<td><?php echo $user['FirstName'] ?></td>
							<td><?php echo $user['LastName'] ?></td>
							<td><?php echo $user['Street_Address'] ?></td>
							<td><?php echo $user['City'] ?></td>
							<td><?php echo $user['Province'] ?></td>
							<td><?php echo $user['Zipcode'] ?></td>
						</tr>
				<?php
					}
				?>

			</table>
			<a href="listAllUser3"><h2>Back to Index</h2></a>
		</div>
	</body>
</html>



