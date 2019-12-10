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
            <?php 
                $message = $data['theMessage'];
                $sender =$data['sender'];
                $receiver = $data['receiver'];

        
            ?>    
                <form  name= "ViewMsgForm" id="ViewMsgForm"> 

                <br/>
                <h2> Message Detail</h2>
                        <label id="receiverLabel">To &nbsp; &nbsp;
                        </label>
                        <p><?php echo $receiver->Username;?> </p>
                        <label id="titleLabel">Title 
                        </label>
                        <p><?php echo $message->Title;?> <p/>

                        <label id="senderLabel">From &nbsp; &nbsp;
                        </label>
                        <p> <?php echo $sender->Username;?> <p/>
                        <label id="messageLabel">Message </label>
                        &nbsp; &nbsp;
                        <p> 
                         <?php echo $message->Message;?>
                         </p> 
                        <br/> <br/>
                </form>
                 <button><a href ="<?php echo 'listMessages' ?>">Return to Inbox </a></button>
            </div>
        </div>
    </body>
</html>



