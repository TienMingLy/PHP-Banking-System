<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/user/list_user_security_question.css">
		<title>Security Question Page</title>
	</head>
	
	<body>
		<div id="securityQuestionDiv">					
			<table id="securityQuestionTable">
				<thead>
					<tr>
						<th colspan="8"><h2><?php echo $_SESSION['username']?>'s Security Question Table</h2></th>
					</tr>

					<t>
						<th>Question</th>
						<th>Edit</th>
						<th>Delete</th>
					</t>
				</thead>

				<tbody>
				<?php								
					foreach($data['userSecurityQuestions'] as $user)
					{
				?>
						<tr>
							<td><?php echo $user['Question'] ?></td>
							<td><a href="editUserSecurityQuestion?User_id=<?=$user['User_Security_id']?>"><input type="submit" value="Edit"></input></a></td>
							<td><a href="deleteUserSecurityQuestion?User_id=<?=$user['User_Security_id']?>"><input type="submit" value="Delete"></input></a></td>
						</tr>
				<?php
					}
				?>
				</tbody>
			</table>
			<a href="/../home/index"><h2>Back to Index</h2></a>	
		</div>
	</body>
</html>



