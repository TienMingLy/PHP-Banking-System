<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/adminLevel_3/list_user_contact_info.css">
		<title><?php echo $_SESSION['client_username']?>'s Contact Info Page</title>
	</head>

	<body>
		<div id="userContactInfoListDiv">
			<table width="600" border="1" cellpadding="1" cellspacing="1" id="userContactInfoTable">
				<tr>
					<th colspan="8"><h2><?php echo $_SESSION['client_username']?>'s Contact Info Table</h2></th>
				</tr>

				<t>
					<th>Type</th>
					<th>Info</th>
				</t>

				<?php
					foreach($data['userContactInfos'] as $user)
					{
				?>
						<tr>
							<td><?php echo $user['Type'] ?></td>
							<td><?php echo $user['Info'] ?></td>
						</tr>
				<?php
					}
				?>

			</table>

			<!-- This one works, because he doesn't need argument -->
			<a href="listAllUser3"><h2>Back to Index</h2></a>
		</div>
	</body>
</html>



