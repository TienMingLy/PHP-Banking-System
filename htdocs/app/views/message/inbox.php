<html>
  <head>
<?php
   include('userNavBar.php');
?>
</head>
<body>
<div class="mailbox">
  
  <div class="navLists">
    <a href="<?php echo 'create' ?>">compose</a>
    <a href="<?php echo 'listMessages' ?>" class="active">inbox</a>
    <a href="<?php echo 'sentMessages' ?>">sent</a>
  </div>
  <div class="messages">
 
    <div class="message">
        
          <span class="read" style="font-weight:bold;">Read</span>
          <span class="sender" style="font-weight:bold;">Sender</span>
          <span class="title" style="padding-left: 170px; font-weight:bold;">Title</span>
          <span class="date" style="padding-right: 100px; font-weight:bold;">Date</span>

    </div>
    <?php
      if($data['theMessage'] != null){

          $senderUser = $data['user'];

         foreach($data['theMessage'] as $message)
        {
            $sender = $senderUser->getUserFromId($message['Sender_id']);
            
       ?>   
          <div class="message">
          
             <input class="read" type="checkbox" disabled='disabled'
              <?php if ($message['Message_Read'] == '1'){
                     echo "checked='checked'";
                     } ?> 
              />
              <span class="sender"><?php echo $sender->Username; ?></span>
              <span class="title"><?php echo $message['Title']; ?></span>
              <span class="date"><?php echo $message['Time_Created']; ?></span>
               <a class="btnView" id="MsgView" href='viewReceivedMessage?Message_id=<?=$message["Message_id"] ?>'>
               View </a>
             
              <a class="btnDelete" href='deleteMail?Message_id=<?=$message["Message_id"] ?>'>Delete</a>

          </div>
      <?php
          
         }
      }
      else{
          echo "<h2> You have no message(s) </h2>";
      }
      ?>
    
  </div>
</div>
</body>
</html>