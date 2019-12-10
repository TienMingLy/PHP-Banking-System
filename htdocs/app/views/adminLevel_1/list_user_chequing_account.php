<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/adminLevel_1/list_user_chequing_account.css">
		<title><?php echo $_SESSION['client_username']?>'s Chequing Page</title>
	</head>
	
	<body>
		<div id="userChequingListDiv">					
			<table id="userChequingAccountTable">
				<thead>
					<tr>
						<th colspan="8"><h2><?php echo $_SESSION['client_username']?>'s Chequing Account Table</h2></th>
					</tr>

					<t>
						<th>Account Name</th>
						<th>Account Number</th>	
						<th>Account Created</th>
						<th>Amount</th>
						<th>Recent Transaction</th>
					</t>
				</thead>
				<tbody>	
				<?php								
					foreach($data['chequingAccs'] as $userChequing)
					{
				?>
						<tr>
							<td><?php echo $userChequing['Account_Name']?></td>
							<td><?php echo $userChequing['Account_Num']?></td>
							<td><?php echo $userChequing['Account_Created']?></td>
							<td><?php echo "$".number_format((float)$userChequing['Amount'], 2, '.', '')?></td>	
							<td><a href="/../admin/listTheUserChequingRecentTransaction1?User_Chequing_id=<?=$userChequing['User_Chequing_id']?>"><input type="submit" value="View"></input></a></td>					
						</tr>
				<?php
					}
				?>
				</tbody>	
			</table>
			<a href="listAllUser1"><h2>Back</h2></a>			
		</div>
	</body>
</html>