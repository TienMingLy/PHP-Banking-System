<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/user/refuse_e_transfer.css">
		<title>Refusal Form</title>
	</head>
	
	<body>
		<div id="eTransferRefuseDiv" style="height: 800px;">
			<form action='' method='post' id="e_transfer_refuse_Form" >
				<br/>
				<img src="../../images/TheBank_Logo_Transparent.png" id="theBankLogoImg" alt="The Bank Logo">
				<label id="eTransferLabel">E-Transfer Rejection</label>
				<br/>

				<h2 id="areYouSureH2">Are you sure you want to refuse this e-transfer?</h2>

				<?php
					foreach($data['e_transfer_data'] as $e_Transfer)
					{
						//Gets the username from his user_id
						$userModel = $this->Model('User');
						$theSender = $userModel->getUserFromId($e_Transfer['Sender_id']);
						$sender_username = $theSender->Username;
				?>
				<label id="usernameLabel">From<input type="text"  id="usernameInput" value="<?php echo $sender_username?>" readonly></label>
				<label id="amountLabel">Amount<input type='text' id='amountInput' value="$<?php echo $e_Transfer['Amount']?>" readonly></label>
				<br/><br/>
				<label id="messageLabel">Message<textarea rows="3" cols="40"  id='messageInput' readonly><?php echo $e_Transfer['Message']?></textarea></label>
				<input type='submit' name='action' value='Refuse' id="refuseButton"/>
				<br/>
				<a href="/../user/list_e_transfer_received"><h2>Back to E-Transfer</h2></a>	
				<?php
					}
				?>
			</form>
		</div>
	</body>
</html>