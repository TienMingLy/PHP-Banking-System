<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/adminLevel_1/list_user_saving_account.css">
		<title><?php echo $_SESSION['client_username']?>'s Saving Account Page</title>
	</head>
	
	<body>
		<div id="userSavingListDiv">					
			<table id="userSavingAccountTable">
				<tr>
					<th colspan="8"><h2><?php echo $_SESSION['client_username']?>'s Saving Account Table</h2></th>
				</tr>

				<t>
					<th>Account Name</th>
					<th>Account Number</th>	
					<th>Account Created</th>
					<th>Amount</th>
					<th>Recent Transaction</th>
				</t>

				<?php
					foreach($data['savingAccs'] as $userSaving)
					{
				?>
						<tr>
							<td><?php echo $userSaving['Account_Name']?></td>
							<td><?php echo $userSaving['Account_Num']?></td>
							<td><?php echo $userSaving['Account_Created']?></td>
							<td><?php echo "$".number_format((float)$userSaving['Amount'], 2, '.', '')?></td>
							<td><a href="/../admin/listTheUserSavingRecentTransaction1?User_Saving_id=<?=$userSaving['User_Saving_id']?>"><input type="submit" value="View"></input></a></td>	
						</tr>
				<?php
					}
				?>

			</table>
			<a href="listAllUser1"><h2>Back</h2></a>			
		</div>
	</body>
</html>