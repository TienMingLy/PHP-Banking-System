<html>
  <head>
        <?php include('userNavBar.php'); ?>

        <title>View Message</title>
    </head>
    
    <body>
        <div class="mailbox">
            <div class="navLists">
                <a href="<?php echo 'create' ?>">compose</a>
                <a href="<?php echo 'listMessages' ?>" >inbox</a>
                <a href="<?php echo 'sentMessages' ?>">sent</a>
            </div>
            <div class="messages">
           
				<h1>Delete this message?</h1>
				<form method='post'>
					<?php 
						
					?>
					<label>To: &nbsp;</label><?php echo $data['receiver']->Username; ?><br>
					<label>Title: &nbsp;</label><?php echo $data['msg']->Title; ?><br>
					<label>From: &nbsp;</label><?php echo $data['sender']->Username; ?><br>
					<label>Message: &nbsp;</label><?php echo $data['msg']->Message; ?><br>
					<label>Date: &nbsp;</label><?php echo $data['msg']->Time_Created; ?><br>
					<?php 
					?>
					<button><input type='submit' name='action' value='Delete' /></button>&nbsp; &nbsp;
					<button ><a href="<?php echo 'listMessages';?>">Cancel</a></button>
				</form>
            </div>
        </div>
    </body>
</html>

