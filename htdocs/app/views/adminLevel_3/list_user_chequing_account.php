<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/adminLevel_3/list_user_chequing_account.css">
		<title><?php echo $_SESSION['client_username']?>'s Chequing Page</title>
	</head>

	<body>
		<div id="userChequingListDiv">
			<table width="600" border="1" cellpadding="1" cellspacing="1" id="userTable">
				<tr>
					<th colspan="8"><h2><?php echo $_SESSION['client_username']?>'s Chequing Account Table</h2></th>
				</tr>

				<t>
					<th>Account Name</th>
					<th>Account Number</th>
					<th>Account Created</th>
					<th>Amount</th>
				</t>

				<?php
					foreach($data['chequingAccs'] as $userChequing)
					{
				?>
						<tr>
							<td><?php echo $userChequing['Account_Name']?></td>
							<td><?php echo $userChequing['Account_Num']?></td>
							<td><?php echo $userChequing['Account_Created']?></td>
							<td><?php echo "$".number_format((float)$userChequing['Amount'], 2, '.', '')?></td>
						</tr>
				<?php
					}
				?>

			</table>

			<a href="listAllUser3"><h2>Back</h2></a>
		</div>
	</body>
</html>