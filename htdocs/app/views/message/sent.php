<html>
  <head>
<?php
   include('userNavBar.php');
?>
<!--
<header>
  <h1>messages</h1>
</header>
-->
</head>
<body>
<div class="mailbox">
  <div class="navLists">
    <a href="<?php echo 'create' ?>">compose</a>
    <a href="<?php echo 'listMessages' ?>" >inbox</a>
    <a href="<?php echo 'sentMessages' ?>" class="active">sent</a>
  </div>

  <div class="messages">

     <div class="message">
         
          <span class="sender" style="font-weight:bold;">Receiver</span>
          <span class="title" style="padding-left:210px; font-weight:bold;">Title</span>
          <span class="date" style="padding-right: 100px; font-weight:bold;">Date</span>
    </div>

    <?php
      if($data['sentMessage']!= null){

        $userModel = $data['user'];

        foreach($data['sentMessage'] as $sentMsgs)
        {
          $userReceiver = $userModel->getUserFromId($sentMsgs['Receiver_id']);
       ?>   
          <div class="message">

            <!--<span class="read">
              <input type="checkbox" 
            <?php //if ($sentMsgs['Message_Read'] == 'true') echo "checked='checked'"; ?> /></span>
            --> 
            <span class="sender">
              <?php echo $userReceiver->Username; ?></span>
            <span class="title">
              <?php echo $sentMsgs['Title']; ?></span>
            <span class="date">
              <?php echo $sentMsgs['Time_Created']; ?>
              </span>
            <a class="btnView" id="sentView" href='viewSentMessage?Message_id=<?=$sentMsgs["Message_id"] ?>'>View  </a>
            <a class="btnDelete" href='deleteMail?Message_id=<?=$sentMsgs["Message_id"] ?>'>Delete</a>

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

