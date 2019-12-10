<html>
	<head>
		<?php include('userNavbar.php')?>
		<link rel="stylesheet" type="text/css" href="../css/user/list_e_transfer_received.css">
		<title>E-Transfer Received</title>
	</head>
	
	<body>
		<div id="userETransferReceivedListDiv">		
			<a href="/../user/e_transfer"><h4>Create New E-Transfer</h4></a>	
			<p>-------------------------------------------</p>
			<a href="/../user/list_e_transfer_sent"><h4>My Sent E-Transfer</h4></a>			
			<table id="userETransferReceivedTable">
				<thead>
					<tr>
						<th colspan="6"><h2>E-Transfer Received</h2></th>
					</tr>

					<t>
						<th>Amount</th>
						<th>Status</th>
						<th>Time Received</th>
						<th>From</th>
						<th></th>
						<th></th>
					</t>
				</thead>
				<tbody>
				<?php								
					foreach($data['e_transfer_received'] as $e_transfer)
					{
				?>
						<tr>
							<td><?php echo "$".$e_transfer['Amount'] ?></td>

							<?php 
								if($e_transfer['Status'] == "Pending")
								{
							?>
									<td>Waiting To Accept</td>		
							<?php				
								}
								else if($e_transfer['Status'] == "Refused" || $e_transfer['Status'] == "Refunded")
								{
							?>
									<td>Rejected</td>
							<?php
								}
								else if($e_transfer['Status'] == "Accepted")
								{
							?>
									<td>Accepted</td>
							<?php
								}
							?>
							
							<td><?php echo $e_transfer['Time_Sent'] ?></td>

							<?php 
								{
									$userModel = $this->Model('User');
									$theSender = $userModel->getUserFromId($e_transfer['Sender_id']);
							?>
									<td><?php echo $theSender->Username?></td>		
							<?php				
								}
							?>

							<?php 
								if($e_transfer['Status'] == "Pending")
								{
							?>
									<td><a href="accept_e_transfer?Money_Transfer_id=<?=$e_transfer['Money_Transfer_id']?>"><input type="submit" value="Accept"></input></a></td>
									<td><a href="refuse_e_transfer?Money_Transfer_id=<?=$e_transfer['Money_Transfer_id']?>"><input type="submit" value="Refuse"></input></a></td>
							<?php
								}

								//If it's accepted 
								else if($e_transfer['Status'] == "Accepted" || $e_transfer['Status'] == "Refused" || $e_transfer['Status'] == "Refunded")
								{
							?>
									<td></td>
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



