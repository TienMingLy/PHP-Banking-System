<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/user/cancel_e_transfer.css">
		<title>Cancel Form</title>
	</head>
	
	<body>
		<div id="e_TransferCancelDiv">
			<form action='' method='post' id="e_transfer_cancel_Form">
				<br/>
				<img src="../../images/TheBank_Logo_Transparent.png" id="theBankLogoImg" alt="The Bank Logo">
				<label id="e_TransferLabel">E-Transfer Cancel</label>
				<br/>
				<?php
					foreach($data['e_transfer_data'] as $e_Transfer)
					{
						//Gets the username from his user_id
						$userModel = $this->Model('User');
						$theReceiver = $userModel->getUserFromId($e_Transfer['Receiver_id']);
						$receiver_username = $theReceiver->Username;
				?>
				<label id="usernameLabel">To<input type="text" id="usernameInput" name="username" value="<?php echo $receiver_username?>" readonly/></input></label>
				<label id="amountLabel">Amount<input type='text' id='amountInput' value="<?php echo "$".$e_Transfer['Amount']?>" name='amount' readonly /></label>
				<br/><br/>								
				<input type='submit' name='action' value='Cancel' id="acceptButton"/>
				<br/><br/>
				<a href="/../user/list_e_transfer_received"><h2>Back to E-Transfer</h2></a>	
				<?php
					}
				?>
			</form>
		</div>
	</body>
</html>