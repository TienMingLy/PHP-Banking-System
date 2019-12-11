<html>
	<head>
		<?php include('userNavbar.php')?>
		<link rel="stylesheet" type="text/css" href="../css/user/list_e_transfer_sent.css">
		<title>E-Transfer Sent</title>
	</head>
	
	<body>
		<div id="userETransferSentListDiv">		
			<a href="/../user/list_e_transfer_received"><h4>My Received E-Transfer</h4></a>			
			<table id="userETransferSentTable">
				<thead>
					<tr>
						<th id="tableNameTh" colspan="5"><h2>E-Transfer Sent</h2></th>
					</tr>

					<t>
						<th>Amount</th>
						<th>Status</th>
						<th>Time Sent</th>
						<th>To</th>	
						<th></th>
					</t>
				</thead>
				<tbody>
				<?php								
					foreach($data['e_transfer_sent'] as $e_transfer)
					{
				?>
						<tr>
							<td><?php echo "$".$e_transfer['Amount'] ?></td>
							<td><?php echo $e_transfer['Status'] ?></td>
							<td><?php echo $e_transfer['Time_Sent'] ?></td>
					<?php 
							$userModel = $this->Model('User');
							$theReceiver = $userModel->getUserFromId($e_transfer['Receiver_id']);
					?>
							<td><?php echo $theReceiver->Username?></td>		
					<?php				
							if($e_transfer['Status'] == "Refused")
							{
					?>
							<td><a href="redeem_e_transfer?Money_Transfer_id=<?=$e_transfer['Money_Transfer_id']?>"><input type="submit" value="Redeem"></input></a></td>
					<?php
							}

							else if($e_transfer['Status'] == "Pending" || $e_transfer['Status'] == "Accepted" || $e_transfer['Status'] == "Refunded")
							{
					?>
								<td></td>
				<?php
							}
					?>		
						</tr>
				<?php						
					}
				?>
						
				</tbody>
			</table>			
		</div>
	</body>
</html>