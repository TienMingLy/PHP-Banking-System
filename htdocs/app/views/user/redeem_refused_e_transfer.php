<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/user/redeem_refused_e_transfer.css">
		<title>Redeem Form</title>
	</head>
	
	<body>
		<div id="e_TransferRedeemDiv">
			<form action='' method='post' id="e_transfer_redeem_Form">
				<br/>
				<img src="../../images/TheBank_Logo_Transparent.png" id="theBankLogoImg" alt="The Bank Logo">
				<label id="e_TransferLabel">E-Transfer Redeem</label>
				<br/>
				<?php
					foreach($data['e_transfer_data'] as $e_Transfer)
					{
				?>
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
				<br/>
				<input type='submit' name='action' value='Redeem' id="redeemButton"/>
				<br/><br/>
				<a href="/../user/list_e_transfer_sent"><h2>Back to E-Transfer</h2></a>	
				<?php
					}
				?>
			</form>
		</div>
	</body>
</html>