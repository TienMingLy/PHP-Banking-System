<html>
	<head>
		<?php include('userNavBar.php'); ?>

		<title>Create Message</title>
	</head>
	
	<body>
		<div class="mailbox">
		  	<div class="navLists">
			    <a href="<?php echo 'create' ?>" class="active">compose</a>
			    <a href="<?php echo 'listMessages' ?>" >inbox</a>
			    <a href="<?php echo 'sentMessages' ?>" >sent</a>
		  	</div>
		  	<div class="messages">

				<form action='' method='post' id="messageInfoForm">
					<br/><br/>
					
					<label id="receiverLabel">To <input type="text" id="ReceiverInput"placeholder="Enter username" name='receiver' required/></label>
					<br/>
					<label id="titleLabel">Title <input type='text' id="titleInput" placeholder="Title" name='title' required/></label>
					<br/>
					<label id="messageLabel">Message </label><br/>
					&nbsp; &nbsp; &nbsp; &nbsp;
					<textarea 
					placeholder ="Type your message here... " rows="12" cols="70" maxlength="65535" required name="message" style="font-size: 20px;">  </textarea> 

					<br/> <br/>
					<button type='submit' name='send' id="SendButton">
					Send</button>
				</form>
			</div>
		</div>
	</body>
</html>

