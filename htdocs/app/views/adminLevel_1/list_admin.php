<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/adminLevel_1/list_admin.css">
		<title>List Of Admin Page</title>
	</head>
	
	<body>
		<div id="adminListDiv" style="overflow-x:auto;">
			<table id="listAdminTable">
				<thead>
					<tr>
						<th colspan="8"><h2>Administrator Table</h2></th>
					</tr>

					<t>
						<th>Username</th>
						<th>Privileged Level</th>
						<th>Last Login Date</th>
						<th>Reset PW</th>	
						<th>Delete</th>
					</t>
				</thead>
				<tbody>
					<?php								
						foreach($data['admins'] as $admin)
						{
					?>
							<tr>
								<td><?php echo $admin['Username'] ?></td>
								<td><?php echo $admin['Privileged_Level'] ?></td>
								<td><?php echo $admin['Last_Login_Date'] ?></td>
								<td><a href="editAdminPassword1?Admin_id=<?=$admin['Admin_id']?>"><input type="submit" value="Edit"></input></a></td>
								<td><a href="deleteAdminAccount1?Admin_id=<?=$admin['Admin_id']?>"><input type="submit" value="Delete"></input></a></td>
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