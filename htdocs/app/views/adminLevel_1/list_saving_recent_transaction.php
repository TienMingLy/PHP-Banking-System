<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/adminLevel_1/list_saving_recent_transaction.css">
		<title><?php echo $_SESSION['username']?>'s Saving Recent</title>
	</head>
	
	<body>
		<div id="userSavingRecentTransactionListDiv">					
			<table id="userSavingRecentTransactionTable">
				<thead>
					<tr>
						<th colspan="8"><h2>Saving Recent Transaction</h2></th>
					</tr>

					<t>
						<th>Amount</th>
						<th>Transaction_Type</th>	
						<th>Transaction_Timestamp</th>	
					</t>
				</thead>
				<tbody>
				<?php								
					foreach($data['savingRecentTransactions'] as $transaction)
					{
				?>
						<tr>
						<?php
							//If it's incoming transaction
							if((strpos($transaction['Transaction_Type'], 'Transfer from') !== false) ||
							   (strpos($transaction['Transaction_Type'], 'E-Transfer from') !== false) || 
							   (strpos($transaction['Transaction_Type'], 'Refunded from') !== false) ||
							   (strpos($transaction['Transaction_Type'], 'First Time Deposit') !== false))
							{
						?>
							<td><?php echo "+$".$transaction['Amount'] ?></td>
						<?php
							}

							//If it's outgoing transaction
							else if((strpos($transaction['Transaction_Type'], 'Transfer to') !== false) ||
						   	   		(strpos($transaction['Transaction_Type'], 'E-Transfer to') !== false))
							{
						?>
							<td><?php echo "-$".$transaction['Amount'] ?></td>
						<?php
							}
							else
							{
						?>
							<td><?php echo "$".$transaction['Amount'] ?></td>
						<?php
							}
						?>
							<td><?php echo $transaction['Transaction_Type'] ?></td>
							<td><?php echo $transaction['Transaction_Timestamp'] ?></td>
						</tr>
				<?php
					}
				?>
				</tbody>
			</table>
			<a href="/../admin/listAllUser1"><h2>Back to Index</h2></a>			
		</div>
	</body>
</html>



