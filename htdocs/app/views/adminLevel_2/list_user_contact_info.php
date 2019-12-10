<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/adminLevel_2/list_user_contact_info.css">
		<title><?php echo $_SESSION['client_username']?>'s Contact Info Page</title>
	</head>
	
	<body>
		<div id="userContactInfoListDiv">					
			<table width="600" border="1" cellpadding="1" cellspacing="1" id="userContactInfoTable">
				<thead>
					<tr>
						<th colspan="8"><h2><?php echo $_SESSION['client_username']?>'s Contact Info Table</h2></th>
					</tr>

					<t>
						<th>Type</th>
						<th>Info</th>	
						<th>Edit</th>	
					</t>
				</thead>
				<tbody>
				<?php								
					foreach($data['userContactInfos'] as $user)
					{
				?>
						<tr>
							<td><?php echo $user['Type'] ?></td>
							<td><?php echo $user['Info'] ?></td>
							<td><a href="editUserContactInfo2?User_id=<?=$user['User_id']?>"><input type="submit" value="Edit"></input></a></td>
						</tr>
				<?php
					}
				?>
				</tbody>
			</table>

			<!-- This one works, because he doesn't need argument -->
			<a href="listAllUser1"><h2>Back to Index</h2></a>			
		</div>
	</body>
</html>



