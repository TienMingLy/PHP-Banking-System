<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/adminLevel_3/list_user.css">
		<title>List Of User Page</title>
	</head>

	<body>
		<div id="userListDiv">
			<table width="900" id="listUserTable">
				<thead>
					<tr>
						<th colspan="9"><h2>User Table</h2></th>
					</tr>

					<t>
						<th>User_id</th>
						<th>Username</th>
						<th>Last Login Date</th>
						<th>Chequing Account</th>
						<th>Saving Account</th>
						<th>Recent Transaction</th>
						<th>Information</th>
						<th>Contact Info</th>
					</t>
				</thead>

				<tboby>
				<?php
					foreach($data['users'] as $user)
					{
				?>
						<tr>
							<td><?php echo $user['User_id'] ?></td>
							<td><?php echo $user['Username'] ?></td>
							<td><?php echo $user['Last_Login_Date'] ?></td>
							<td><a href="listAllUserChequingAccount3?User_id=<?=$user['User_id']?>"><input type="submit" value="Chequing View"></input></a></td>
							<td><a href="listAllUserSavingAccount3?User_id=<?=$user['User_id']?>"><input type="submit" value="Saving View"></input></a></td>
							<td><a href="listAllRecentTransaction3?User_id=<?=$user['User_id']?>"><input type="submit" value="View"></input></a></td>
							<td><a href="listAllUserInfo3?User_id=<?=$user['User_id']?>"><input type="submit" value="View"></input></a></td>
							<td><a href="listAllContactInfo3?User_id=<?=$user['User_id']?>"><input type="submit" value="View"></input></a></td>
						</tr>
				<?php
					}
				?>
				</tboby>
			</table>
			<a href="index"><h2>Back to Menu</h2></a>
		</div>
	</body>
</html>



