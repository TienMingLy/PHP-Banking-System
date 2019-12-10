
 <meta charset="utf-8">
 <title>Message</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../css/user/userNavBar.css">
  <link rel="stylesheet" type="text/css" href="../css/home/msg.css">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> 

  <div id="theBankPicture">
     <img src="../../images/TheBank_Logo_Transparent.png" id="theBankLogoImg" alt="Sky Bank Logo">
   
</div>
  
<nav class="navbar navbar-inverse">
  <div class="container-fluid"  id="divforNavBar">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
         <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Sky Bank</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a title="Account" href="<?php echo '/home/index' ?>">Account</a></li>
        <li><a title="Message" href="<?php echo '/message/listMessages' ?>" class="active">Messages</a></li>
        <li><a title="Transfer" href="<?php echo '/user/transferBetweenAccount' ?>">Transfer</a></li>
        <li><a title="E-Transfer" href="<?php echo '/user/list_e_transfer_received' ?>">E-Transfer</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="<?php echo '' ?>"><span class="glyphicon glyphicon-user"></span> <?php  echo " ".$_SESSION['username']; ?>
      </a>
        <ul class="user-sub-menu">
                  <li><a href="<?php  echo'/user/listTheUserInfo'?>">My Information</a></li>
                  <li><a href="<?php  echo'/user/listTheUserContactInfo'?>">My Contact Information</a></li>
                  <li><a href="<?php  echo'/user/listTheUserSecurityQuestion'?>">My Security Questions</a></li>
                  <li><a href="<?php  echo'/user/editUserPassword'?>">Change Password</a></li>
        </ul> 
      </li>
        
         <li><a id="logoutLink" name="logout" href="<?php  echo 'logout' ?>" ><span class="glyphicon glyphicon-log-out"></span>Logout</a></li>
      </ul>
    </div>
  </div>
</nav> 