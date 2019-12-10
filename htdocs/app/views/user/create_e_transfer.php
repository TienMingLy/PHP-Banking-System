<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/user/create_e_transfer.css">
		<title>E-Transfer Form</title>
	</head>
	
	<body>
		<div id="eTransferDiv">
			<form action='' method='post' id="e_transfer_Form">
				<br/>
				<img src="../../images/TheBank_Logo_Transparent.png" id="theBankLogoImg" alt="The Bank Logo">
				<br/><br/>
				<label id="eTransferLabel">E-Transfer Form</label>
				<br/>
				<label id="usernameLabel">Username<input type="text" placeholder='Enter recipient username' id="usernameInput" name='username'/></input></label>
				<br/>
				<label id="fromLabel">From
					<select name="from_Option" id="fromAccountSelectBox" required>
						<option disabled selected value> -- Select the account -- </option>
						<?php 
							foreach($data['chequing'] as $userChequing)
						{
						?>
							<option value="<?php echo $userChequing['User_Chequing_id']?>"><?php echo $userChequing['Account_Name']?>--<?php echo $userChequing['Amount']?> </option>			

						<?php
						}
						?>

						<?php 
							foreach($data['saving'] as $userSaving)
						{
						?>
							<option value="<?php echo $userSaving['User_Saving_id']?>"><?php echo $userSaving['Account_Name']?>---<?php echo $userSaving['Amount']?> </option>			

						<?php
						}
						?>
				</select></label>
				<br/>
				<label id="amountLabel">Amount<input type='text' id='amountInput' placeholder='Enter the amount' name='amount' required/></label>
				<br/>
				<label id="securityQuestionLabel">Question<input type='text' id='securityQuestionInput' placeholder='Enter the security question' name='security_question' required/></label>
				<br/>
				<label id="answerLabel">Answer<input type='password' id='answerInput' placeholder='Enter the answer' name='answer_hash' required/></label>
				<br/><br/>
				<label id="messageLabel">Message<textarea rows="4" cols="50" id='messageInput' placeholder='(Optional)' name='message'></textarea></label>
				<br/>
				<input type='submit' name='action' value='Send' id="sendButton"/>
				<br/><br/>
				<a href="/../user/list_e_transfer_received"><h2>Back to E-Transfer</h2></a>	
			</form>
		</div>
	</body>
</html>