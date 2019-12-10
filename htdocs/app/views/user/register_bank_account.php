<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/user/register_bank_account.css">
		<title>New Bank Account Page</title>
	</head>
	
	<body>
		<div id="newAccountTypeDiv">
			<form action='' method='post' id="newAccountTypeForm">
				<br/>
				<img src="../../images/TheBank_Logo_Transparent.png" id="theBankLogoImg" alt="The Bank Logo">
				<br/>
				<h2 id="newBankAccountH2">Create a new bank account</h2>
				<br/>
				<label id="accountTypeLabel"><b>Account Type</b>
				<select name="account_type_Option" id="accountTypeSelectBox" required>
						<option disabled selected value> -- Select the account type -- </option>
						<option value="chequing">Chequing</option>
						<option value="saving">Saving</option>					
				</select>
				<br/>
				<label id="accountNameLabel"><b>Account Name</b><input type="text" id="accountNameInput"placeholder="Enter the account name" name='account_name' required/></label>
				
				<label id="amountLabel"><b>Amount</b><input type='text' id="amountInput" placeholder="Enter the amount" name='amount' required/></label>

				<input type='submit' name='action' value='Create' id="createButton"/>
				<br/><br/>
			</form>
			<a href="index">Back to Index</a>
		</div>
	</body>
</html>