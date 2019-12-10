<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/adminLevel_3/list_user_recent_transaction.css">
		<title><?php echo $_SESSION['client_username']?>'s Recent Transaction Page</title>
	</head>

	<body>
		<div id="userRecentTransactionListDiv">
			<table width="600" border="1" cellpadding="1" cellspacing="1" id="userTable">
				<tr>
					<th colspan="8"><h2><?php echo $_SESSION['client_username']?>'s Recent Transaction Table</h2></th>
				</tr>

				<t>
					<th>Transaction_id</th>
					<th>Amount</th>
					<th>Transaction Type</th>
					<th>Timestamp</th>
					<th>Account Type</th>

				</t>

				<?php
					foreach($data['recentTrans'] as $recentTransaction)
					{
				?>
						<tr>
							<td><?php echo $recentTransaction['Transaction_id']?></td>
							<td><?php echo "$".number_format((float)$recentTransaction['Amount'], 2, '.', '')?></td>
							<td><?php echo $recentTransaction['Transaction_type']?></td>
							<td><?php echo $recentTransaction['Timestamp']?></td>
							<td><?php echo $recentTransaction['Account_Type']?></td>

						</tr>
				<?php
					}
				?>

			</table>

			<a href="listAllUser3"><h2>Back</h2></a>
		</div>
	</body>
</html>