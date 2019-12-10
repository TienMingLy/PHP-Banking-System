<html>
	<head>
		<?php include('userNavbar.php')?>
		<title>Homepage</title>

	</head>
	
	<body>
		<a href="/../user/registerNewBankAccount"><h4>Create New Account</h4></a>
		<table id="chequingTable">
			<thead>
				<tr>
					<th colspan="11"><h2>Chequing</h2></th>
				</tr>

				<t>
					<th>Account Name</th>
					<th>Account Number</th>
					<th>Amount</th>	
					<th>Account Created</th>
					<th>Recent Transaction</th>
				</t>
			</thead>
			<tbody>
		<?php								
			foreach($data['chequing'] as $userChequing)
			{
		?>
				<tr>
					<td><?php echo $userChequing['Account_Name'] ?></td>
					<td><?php echo $userChequing['Account_Num'] ?></td>
					<td><?php echo "$".$userChequing['Amount'] ?></td>
					<td><?php echo $userChequing['Account_Created'] ?></td>
					<td><a href="/../user/listTheUserChequingRecentTransaction?User_Chequing_id=<?=$userChequing['User_Chequing_id']?>"><input type="submit" value="View"></input></a></td>
				</tr>
		<?php
			}
		?>
			</tbody>
		</table>

		<br/>

		<table id="savingTable">
			<thead>
				<tr>
					<th colspan="11"><h2>Saving</h2></th>
				</tr>

				<t>
					<th>Account Name</th>
					<th>Account Number</th>
					<th>Amount</th>	
					<th>Account Created</th>
					<th>Recent Transaction</th>
				</t>
			</thead>	
			<tbody>
		<?php								
			foreach($data['saving'] as $userSaving)
			{
		?>
				<tr>
					<td><?php echo $userSaving['Account_Name'] ?></td>
					<td><?php echo $userSaving['Account_Num'] ?></td>
					<td><?php echo "$".$userSaving['Amount'] ?></td>
					<td><?php echo $userSaving['Account_Created'] ?></td>
					<td><a href="/../user/listTheUserSavingRecentTransaction?User_Saving_id=<?=$userSaving['User_Saving_id']?>"><input type="submit" value="View"></input></a></td>
				</tr>
		<?php
			}
		?>
			</tbody>
		</table>
	</body>
</html>