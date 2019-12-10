<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/user/register_user_security_question.css">
		<title>Register Security Question Page</title>
	</head>
	
	<body>
		<div id="registerSecurityQuestionDiv">

			<form action='' method='post' id="registerSecurityQuestionForm">
				<br/>
				<img src="../../images/TheBank_Logo_Transparent.png" id="theBankLogoImg" alt="The Bank Logo">
				<br/><br/>
				<label id="personalSecurityQuestionLabel">Your Security Question</label>
				<label id="questionLabel">Question<input type="text" id="questionInput" placeholder="Enter question" name='question' required/></label>
				<br/>
				<label id="answerLabel">Answer<input type='text' id="answerInput" placeholder="Enter answer" name='answer_hash' required/></label>
				<br/><br/>
				<input type='submit' name='action' value='Next' id="nextButton"/>
			</form>
		</div>
	</body>
</html>

