<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/user/accept_e_transfer.css">
		<title>Accept Form</title>
	</head>
	
	<body>
		<div id="e_TransferAcceptDiv">
			<form action='' method='post' id="e_transfer_accept_Form">
				<br/>
				<img src="../../images/TheBank_Logo_Transparent.png" id="theBankLogoImg" alt="The Bank Logo">
				<label id="e_TransferLabel">E-Transfer Acceptance</label>
				<br/>
				<?php
					foreach($data['e_transfer_data'] as $e_Transfer)
					{
						//Gets the username from his user_id
						$userModel = $this->Model('User');
						$theSender = $userModel->getUserFromId($e_Transfer['Sender_id']);
						$sender_username = $theSender->Username;
				?>
				<label id="usernameLabel">From<input type="text" id="usernameInput" name="username" value="<?php echo $sender_username?>" readonly/></input></label>
				<label id="amountLabel">Amount<input type='text' id='amountInput' value="<?php echo "$".$e_Transfer['Amount']?>" name='amount' readonly /></label>
				<br/><br/>
				<label id="toLabel">Deposit at
					<select name="to_Option" id="toAccountSelectBox" required>
						<option disabled selected value> -- Select the account -- </option>

						<?php 
							foreach($data['chequing_account'] as $userChequing)
						{
						?>
							<option value="<?php echo $userChequing['User_Chequing_id']?>"><?php echo $userChequing['Account_Name']?>--<?php echo $userChequing['Amount']?> </option>			

						<?php
						}
						?>

						<?php 
							foreach($data['saving_account'] as $userSaving)
						{
						?>
							<option value="<?php echo $userSaving['User_Saving_id']?>"><?php echo $userSaving['Account_Name']?>---<?php echo $userSaving['Amount']?> </option>			

						<?php
						}
						?>
				</select></label>

				<br/><br/>
				<label id="messageLabel">Message<textarea rows="4" cols="50"  id='messageInput' readonly><?php echo $e_Transfer['Message']?></textarea></label>
				<br/><br/>
				<label id="securityQuestionLabel">Question<input type='text' id='securityQuestionInput' value='<?php echo $e_Transfer['Security_Question']?>'/></label>
				<br/><br/>
				<label id="answerLabel">Answer<input type='text' id='answerInput' placeholder='Enter the answer' name='answer_hash' required/></label>
				<br/><br/>
				<input type='submit' name='action' value='Accept' id="acceptButton"/>
				<br/><br/>
				<a href="/../user/list_e_transfer_received"><h2>Back to E-Transfer</h2></a>	
				<?php
					}
				?>
			</form>
		</div>
	</body>
</html>