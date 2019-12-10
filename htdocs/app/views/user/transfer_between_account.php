<html>
	<head>
		
		<link rel="stylesheet" type="text/css" href="../css/user/transfer_between_account.css">
		<?php include('userNavbar.php');?>
		<title>Transfer Balance</title>
	</head>
	
	<body>
		<div id="transferBalanceDiv">
			<form action='' method='post' id="transfer_balance_Form">
				<br/>
				<img src="../../images/TheBank_Logo_Transparent.png" id="theBankLogoImg" alt="The Bank Logo">
				<br/><br/>
				<label id="transferBalanceLabel">Balance Transfer</label>
				<br/><br/><br/>
				<label id="senderLabel"><b>Sender</b></label>
				<select name="sender_Option" id="senderSelectBox" required>
						<option disabled selected value>-- Select the account -- </option>

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


				</select>

				<br/>

				<label id="receiverLabel"><b>Receiver</b></label>
				<select name="receiver_Option" id="receiverSelectBox" required>
						<option disabled selected value>-- Select the account -- </option>
						<?php 
							foreach($data['chequing'] as $userChequing)
						{
						?>
							<option value="<?php echo $userChequing['User_Chequing_id']?>"><?php echo $userChequing['Account_Name']?>---<?php echo $userChequing['Amount']?> </option>			

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
				</select>
				<br/>
				<label id="amountLabel"><b>Amount</b><input type='text' id="amountInput" placeholder="Enter the amount" name='amount' required/></label>
				<br/>
				<input type='submit' name='action' value='Save' id="saveButton"/>
				<br/>
			</form>
		</div>
	</body>
</html>