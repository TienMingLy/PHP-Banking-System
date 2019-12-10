<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/adminLevel_2/list_user.css">
		<title>List Of User Page</title>
	</head>
	
	<body>
		<div id="userListDiv">					
			<table width="900" id="listUserTable">
				<thead>
					<tr>
						<th colspan="8"><h2>User Table</h2></th>
					</tr>

					<t>
						<th>User_id</th>
						<th>Username</th>
						<th>Last Login Date</th>
						<th>Status</th>	
						<th>Chequing Account</th>
						<th>Saving Account</th>
						<th>Recent Transaction</th>
						<th>Information</th>
						<th>Contact Info</th>
						<th>Reset PW</th>
						<th>Account Status Update</th>
					</t>
				</thead>

				<tbody>
				<?php								
					foreach($data['users'] as $user)
					{
				?>
						<tr>
							<td><?php echo $user['User_id'] ?></td>
							<td><?php echo $user['Username'] ?></td>
							<td><?php echo $user['Last_Login_Date'] ?></td>
							<td> <?php 
									if($user['Active'] == 1)
									{		
										echo 'Active';
									}

									else
									{
										echo 'Deactivated';
									}
							?></td>
							<td><a href="listAllUserChequingAccount2?User_id=<?=$user['User_id']?>"><input type="submit" value="Chequing View"></input></a></td>
							<td><a href="listAllUserSavingAccount2?User_id=<?=$user['User_id']?>"><input type="submit" value="Saving View"></input></a></td>
							<td><a href="listAllRecentTransaction2?User_id=<?=$user['User_id']?>"><input type="submit" value="View"></input></a></td>
							<td><a href="listAllUserInfo2?User_id=<?=$user['User_id']?>"><input type="submit" value="View"></input></a></td>
							<td><a href="listAllContactInfo2?User_id=<?=$user['User_id']?>"><input type="submit" value="View"></input></a></td>
							<td><a href="editUserPassword2?User_id=<?=$user['User_id']?>"><input type="submit" value="Edit"></input></a></td>

							 <?php 
									if($user['Active'] == 1)
									{	
								?>	
										<td><a href="editUserActiveAccount2?User_id=<?=$user['User_id']?>"><input type="submit" value="Deactivate"></input></a></td>
								<?php				
									}

									else
									{
								?>		
										<td><a href="editUserActiveAccount2?User_id=<?=$user['User_id']?>"><input type="submit" value="Reactivate"></input></a></td>
								<?php
									}	
								?>
						</tr>
				<?php
					}
				?>
				</tbody>

			</table>

			<a href="index"><h2>Back to Index</h2></a>			
		</div>
	</body>
</html>



