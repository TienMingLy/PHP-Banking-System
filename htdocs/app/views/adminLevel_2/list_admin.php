<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/adminLevel_2/list_admin.css">
		<title>List Of Admin Page</title>
	</head>
	
	<body>
		<div id="adminListDiv">
			<table width="600" border="1" cellpadding="1" cellspacing="1" id="adminTable">
				<tr>
					<th colspan="8"><h2>Administrator Table</h2></th>
				</tr>

				<t>
					<th>Username</th>
					<th>Privileged Level</th>
					<th>Last Login Date</th>	
				</t>

				<?php								
					foreach($data['admins'] as $admin)
					{
				?>
						<tr>
							<td><?php echo $admin['Username'] ?></td>
							<td><?php echo $admin['Privileged_Level'] ?></td>
							<td><?php echo $admin['Last_Login_Date'] ?></td>
						</tr>
				<?php
					}
				?>
			</table>

			<a href="index"><h2>Back to Index</h2></a>
		</div>
	</body>
</html>