<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/user/list_user_contact_info.css">
		<title><?php echo $_SESSION['client_username']?>'s Contact Info Page</title>
	</head>
	
	<body>
		<div id="userContactInfoListDiv">	
			<a href="registerContactInfo">Create New Contact Info</a>				
			<table id="userContactInfoTable">
				<thead>
					<tr>
						<th colspan="8"><h2><?php echo $_SESSION['username']?>'s Contact Info Table</h2></th>
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
							<td><a href="editUserContactInfo"><input type="submit" value="Edit"></input></a></td>
						</tr>
				<?php
					}
				?>
				</tbody>
			</table>

			<!-- This one works, because he doesn't need argument -->
			<a href="/../home/index"><h2>Back to Index</h2></a>				
		</div>
	</body>
</html>



