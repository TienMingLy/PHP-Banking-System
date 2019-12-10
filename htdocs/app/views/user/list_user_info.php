<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/user/list_user_info.css">
		<title>Info Page</title>
	</head>
	
	<body>
		<div id="userListDiv">					
			<table id="userInfoTable">
				<thead>
					<tr>
						<th colspan="8"><h2><?php echo $_SESSION['username']?>'s Info Table</h2></th>
					</tr>

					<t>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Street Address</th>	
						<th>City</th>
						<th>Province</th>
						<th>Zipcode</th>
						<th>Edit</th>
					</t>
				</thead>

				<tbody>
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
							<td><a href="editUserInfo"><input type="submit" value="View"></input></a></td>
						</tr>
				<?php
					}
				?>
				</tbody>
			</table>
			<a href="/../home/index"><h2>Back to Index</h2></a>	
		</div>
	</body>
</html>



