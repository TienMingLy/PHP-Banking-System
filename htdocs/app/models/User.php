<?php

class User extends Model  //user is sub-class of database
{
	//User login
	public $user_id;
	public $username;
	public $password_hash;
	public $active;
	public $account_created;
	public $last_login_date;

	//User Information
	public $firstname;
	public $lastname;
	public $street_address;
	public $city;
	public $province;
	public $zipcode;

	//User Contact Info
	public $type;
	public $info;

	//User Security Question
	public $user_security_id;
	public $question;
	public $answer_hash;

	//Recent Transaction
	public $transaction_id;
	public $amount;
	public $transaction_type;
	public $transaction_timestamp;
	public $user_chequing_id;
	public $user_saving_id;
	public $account_name;


	//E-Transfer
	public $money_transfer_id;
	public $message;
	public $security_question;
	public $security_answer_hash;
	public $status;
	public $sender_id;
	public $receiver_id;


	//------------------------------------------------GETTER-------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------//
	public function getUser($username)
	{
		$stmt = $this->_connection->prepare("SELECT * FROM User WHERE username LIKE :username");
		$stmt->execute(['username'=>$username]);
		$stmt->setFetchMode(PDO::FETCH_CLASS, "User"); //datatype user
		return $stmt->fetch(); //it should return a user
	}

	public function getUserId($username)
	{
		$stmt = $this->_connection->prepare("SELECT * FROM User WHERE username = ? ");
		$stmt->execute([$username]);
	    $results = $stmt->fetch(PDO::FETCH_ASSOC);
		return  $results['User_id'];
	}

	public function getUserFromId($user_id)
	{
		$stmt = $this->_connection->prepare("SELECT * FROM User WHERE user_id LIKE :user_id");
		$stmt->execute(['user_id'=>$user_id]);
		$stmt->setFetchMode(PDO::FETCH_CLASS, "User"); //datatype user
		return $stmt->fetch(); //it should return a user
	}

	public function getTheChequingAccount($account_name)
	{
		$stmt = $this->_connection->prepare("SELECT * FROM User_Chequing_Account WHERE Account_Name LIKE :account_name AND User_id = '".$_SESSION['user_id']."';");
		$stmt->execute(['account_name' => $account_name]);
		$stmt->setFetchMode(PDO::FETCH_CLASS, "User_Chequing_Account"); //datatype user
		return $stmt->fetch(); 
	}

	public function getTheSavingAccount($amount)
	{
		$stmt = $this->_connection->prepare("SELECT * FROM User_Saving_Account WHERE Amount LIKE :amount AND User_id = '".$_SESSION['user_id']."';");
		$stmt->execute(['amount' => $amount]);
		$stmt->setFetchMode(PDO::FETCH_CLASS, "User_Saving_Account"); //datatype user
		return $stmt->fetch(); 
	}

	public function getTheSecurityQuestion($user_security_id)
	{
		$stmt = $this->_connection->prepare("SELECT * FROM User_Security_Question WHERE User_Security_id LIKE :user_security_id AND User_id = '".$_SESSION['user_id']."';");
		$stmt->execute(['user_security_id'=>$user_security_id]);
		$stmt->setFetchMode(PDO::FETCH_CLASS, "User_Security_id"); //datatype user
		return $stmt->fetch(); 
	}

	public function getTheTransferChequingAccount($user_chequing_id)
	{
		$stmt = $this->_connection->prepare("SELECT * FROM User_Chequing_Account WHERE User_Chequing_id LIKE :user_chequing_id AND User_id = '".$_SESSION['user_id']."';");
		$stmt->execute(['user_chequing_id'=>$user_chequing_id]);
		$stmt->setFetchMode(PDO::FETCH_CLASS, "User_Chequing_Account"); //datatype user
		return $stmt->fetch(); 
	}

	public function getTheTransferSavingAccount($user_saving_id)
	{
		$stmt = $this->_connection->prepare("SELECT * FROM User_Saving_Account WHERE User_Saving_id LIKE :user_saving_id AND User_id = '".$_SESSION['user_id']."';");
		$stmt->execute(['user_saving_id'=>$user_saving_id]);
		$stmt->setFetchMode(PDO::FETCH_CLASS, "User_Saving_Account"); //datatype user
		return $stmt->fetch(); 
	}

	public function getTheETransferInfo($money_transfer_id)
	{
		$stmt = $this->_connection->prepare("SELECT * FROM Money_E_Transfer WHERE money_transfer_id LIKE :money_transfer_id;");
		$stmt->execute(['money_transfer_id'=>$money_transfer_id]);
		$stmt->setFetchMode(PDO::FETCH_CLASS, "Money_E_Transfer"); //datatype user
		return $stmt->fetch(); 
	}
	
	public function getTheETransfer($money_transfer_id)
	{
		$stmt = $this->_connection->prepare("SELECT * FROM Money_E_Transfer WHERE Money_Transfer_id = ?");
		$stmt->execute(array($money_transfer_id));
		return $results = $stmt->fetchAll(); 
	}
	
	public function getAllUserInfo($user_id)
	{
		$stmt = $this->_connection->prepare("SELECT * FROM User_Info WHERE User_id ='".$user_id."';");
		$stmt->execute(['User_id'=>$user_id]);	
		return $results = $stmt->fetchAll(); 	
	}

	public function getAllUserContactInfo($user_id)
	{
		$stmt = $this->_connection->prepare("SELECT * FROM User_Contact_Info WHERE User_id ='".$user_id."';");
		$stmt->execute(['User_id'=>$user_id]);	
		return $results = $stmt->fetchAll(); 	
	}	

	public function getAllSecurityQuestion($user_id)
	{
		$stmt = $this->_connection->prepare("SELECT * FROM User_Security_Question WHERE User_id ='".$user_id."';");
		$stmt->execute(['User_id'=>$user_id]);			
		return $results = $stmt->fetchAll(); 	
	}

	public function getAllThisChequingRecentTransaction($user_chequing_id)
	{
		$stmt = $this->_connection->prepare('SELECT *
    										 FROM Chequing_Recent_Transaction
    										 WHERE User_Chequing_id = ?
											 ORDER BY Transaction_Timestamp DESC' );
		$stmt->execute(array($user_chequing_id));
		return $results = $stmt->fetchAll(); 	
	}

	public function getAllThisSavingRecentTransaction($user_saving_id)
	{
		$stmt = $this->_connection->prepare('SELECT *
    										 FROM Saving_Recent_Transaction
    										 WHERE User_Saving_id = ?
											 ORDER BY Transaction_Timestamp DESC' );
		$stmt->execute(array($user_saving_id));
		return $results = $stmt->fetchAll(); 	
	}


	//----------------------------------------------SHOW-----------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------//

	public function showAllUserChequingAccount($user_id)
	{
		$stmt = $this->_connection->prepare("SELECT * FROM User_Chequing_Account WHERE User_id LIKE :user_id");
		$stmt->execute(['user_id'=>$user_id]);
		return $results = $stmt->fetchAll();
	}

	public function showAllUserSavingAccount($user_id)
	{
		$stmt = $this->_connection->prepare("SELECT * FROM User_Saving_Account WHERE User_id LIKE :user_id");
		$stmt->execute(['user_id'=>$user_id]);
		return $results = $stmt->fetchAll();
	}

	public function showAllETransferSent($sender_id)
	{
		$stmt = $this->_connection->prepare('SELECT * 
											 FROM Money_E_Transfer 
											 WHERE Sender_id = ?
											 ORDER BY Time_Sent DESC' );
		$stmt->execute(array($sender_id));
		return $results = $stmt->fetchAll();
	}

	public function showAllETransferReceived($receiver_id)
	{
		$stmt = $this->_connection->prepare('SELECT * 
											 FROM Money_E_Transfer 
											 WHERE Receiver_id = ?
											 ORDER BY Time_Sent DESC' );
		$stmt->execute(array($receiver_id));
		return $results = $stmt->fetchAll();
	}


	//----------------------------------------------UPDATE---------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------//
		
	public function updateUserAccountStatus($user_id)
	{
		$stmt = $this->_connection->prepare("UPDATE User SET Active = :Active WHERE User_id = '".$user_id."';");
		$stmt->execute(['Active'=>$this->active]);
		return $stmt->rowCount(); 
	}

	public function updateUserInfo($user_id)
	{
		$stmt = $this->_connection->prepare("UPDATE User_Info SET FirstName = :FirstName, LastName = :LastName, Street_Address = :Street_Address, City = :City, Province = :Province, Zipcode = :Zipcode WHERE User_id = '".$user_id."';");
		$stmt->execute(['FirstName'=>$this->firstname, 'LastName'=>$this->lastname, 'Street_Address'=>$this->street_address, 'City'=>$this->city, 'Province'=>$this->province, 'Zipcode'=>$this->zipcode]);
		return $stmt->rowCount(); 
	}

	public function updateUserContactInfo($user_id)
	{
		$stmt = $this->_connection->prepare("UPDATE User_Contact_Info SET Type = :Type, Info = :Info WHERE User_id = '".$user_id."';");
		$stmt->execute(['Type'=>$this->type, 'Info'=>$this->info]);
		return $stmt->rowCount(); 
	}

	public function updateUserLastLogin()
	{
		date_default_timezone_set("America/Toronto");
		$this->last_login_date = date("Y-m-d H:i:s");

		$stmt = $this->_connection->prepare("UPDATE User SET Last_Login_Date = :Last_Login_Date WHERE user_id = '".$_SESSION['user_id']."';");
		$stmt->execute(['Last_Login_Date'=>$this->last_login_date]);
		return $stmt->rowCount(); 
	}

	public function updateUserPassword($user_id)
	{
		$stmt = $this->_connection->prepare("UPDATE User SET Password_Hash = :Password_Hash WHERE User_id = '".$user_id."';");
		$stmt->execute(['Password_Hash'=>$this->password_hash]);
		return $stmt->rowCount(); 
	}

	public function updateChequingAccountAmount($user_chequing_id)
	{
		$stmt = $this->_connection->prepare("UPDATE User_Chequing_Account SET Amount = :Amount WHERE User_Chequing_id = '".$user_chequing_id."';");
		$stmt->execute(['Amount'=>$this->amount]);
		return $stmt->rowCount(); 
	}

	public function updateSavingAccountAmount($user_saving_id)
	{
		$stmt = $this->_connection->prepare("UPDATE User_Saving_Account SET Amount = :Amount WHERE User_Saving_id = '".$user_saving_id."';");
		$stmt->execute(['Amount'=>$this->amount]);
		return $stmt->rowCount(); 
	}

	public function updateETransferStatus($money_transfer_id)
	{
		$stmt = $this->_connection->prepare("UPDATE Money_E_Transfer SET Status = :Status WHERE Money_Transfer_id = '".$money_transfer_id."';");
		$stmt->execute(['Status'=>$this->status]);
		return $stmt->rowCount(); 
	}


	//----------------------------------------------INSERT--------------------------------------------------//
	//------------------------------------------------------------------------------------------------------//
	public function addUser()
	{
		$this->active = true;

		//Apparently America/Montreal is missing
		date_default_timezone_set("America/Toronto");
		$this->account_created = date("Y-m-d H:i:s");

		$stmt = $this->_connection->prepare("INSERT INTO User(Username, Password_Hash, Account_Created, Active) VALUES(:Username, :Password_Hash, :Account_Created, :Active)");
		$stmt->execute(['Username'=>$this->username, 'Password_Hash'=>$this->password_hash, 'Account_Created'=> $this->account_created,'Active'=>$this->active]);

		return $stmt->rowCount();
	}

	public function addUserInfo()
	{
		$stmt = $this->_connection->prepare("INSERT INTO User_Info(FirstName, LastName, Street_Address, City, Province, Zipcode, User_id) VALUES(:FirstName, :LastName, :Street_Address, :City, :Province, :Zipcode, :User_id)");
		$stmt->execute(['FirstName'=>$this->firstname, 'LastName'=>$this->lastname, 'Street_Address'=>$this->street_address, 'City'=>$this->city, 'Province'=>$this->province, 'Zipcode'=>$this->zipcode, 'User_id'=>$_SESSION['user_id']]);
		return $stmt->rowCount();
	}

	public function addUserContactInfo()
	{
		$stmt = $this->_connection->prepare("INSERT INTO User_Contact_Info(Type, Info, User_id) VALUES(:Type, :Info, :User_id)");
		$stmt->execute(['Type'=>$this->type, 'Info'=>$this->info, 'User_id'=>$_SESSION['user_id']]);
		return $stmt->rowCount();
	}

	public function addUserSecurityQuestion()
	{
		$stmt = $this->_connection->prepare("INSERT INTO User_Security_Question(Question, Answer_Hash, User_id) VALUES(:Question, :Answer_Hash, :User_id)");
		$stmt->execute(['Question'=>$this->question, 'Answer_Hash'=>$this->answer_hash, 'User_id'=>$_SESSION['user_id']]);
		return $stmt->rowCount();
	}

	public function addChequingAccount()
	{
		date_default_timezone_set("America/Toronto");
		$this->account_created = date("Y-m-d H:i:s");

		$this->account_num = rand(100000,999999);

		$stmt = $this->_connection->prepare("INSERT INTO User_Chequing_Account(Account_Name, Account_Num, Amount, Account_Created, User_id) VALUES(:Account_Name, :Account_Num, :Amount, :Account_Created, :User_id)");
		$stmt->execute(['Account_Name'=>$this->account_name, 'Account_Num'=>$this->account_num,'Amount'=>$this->amount, 'Account_Created'=>$this->account_created, 'User_id'=>$_SESSION['user_id']]);
		return $stmt->rowCount();
	}

	public function addSavingAccount()
	{
		date_default_timezone_set("America/Toronto");
		$this->account_created = date("Y-m-d H:i:s");

		$this->account_num = rand(100000,999999);

		$stmt = $this->_connection->prepare("INSERT INTO User_Saving_Account(Account_Name, Account_Num, Amount, Account_Created, User_id) VALUES(:Account_Name, :Account_Num, :Amount, :Account_Created, :User_id)");
		$stmt->execute(['Account_Name'=>$this->account_name, 'Account_Num'=>$this->account_num,'Amount'=>$this->amount, 'Account_Created'=>$this->account_created, 'User_id'=>$_SESSION['user_id']]);
		return $stmt->rowCount();
	}
	
	public function addChequingRecentTransaction()
	{
		date_default_timezone_set("America/Toronto");
		$this->transaction_timestamp = date("Y-m-d H:i:s");

		$stmt = $this->_connection->prepare("INSERT INTO Chequing_Recent_Transaction(Amount, Transaction_Type, Transaction_Timestamp, User_Chequing_id) VALUES(:Amount, :Transaction_Type, :Transaction_Timestamp, :User_Chequing_id)");
		$stmt->execute(['Amount'=>"$this->amount", 'Transaction_Type'=>$this->transaction_type,'Transaction_Timestamp'=>$this->transaction_timestamp, 'User_Chequing_id'=>$this->user_chequing_id]);
		return $stmt->rowCount();
	}

	public function addSavingRecentTransaction()
	{
		date_default_timezone_set("America/Toronto");
		$this->transaction_timestamp = date("Y-m-d H:i:s");

		$stmt = $this->_connection->prepare("INSERT INTO Saving_Recent_Transaction(Amount, Transaction_Type, Transaction_Timestamp, User_Saving_id) VALUES(:Amount, :Transaction_Type, :Transaction_Timestamp, :User_Saving_id)");
		$stmt->execute(['Amount'=>$this->amount, 'Transaction_Type'=>$this->transaction_type,'Transaction_Timestamp'=>$this->transaction_timestamp, 'User_Saving_id'=>$this->user_saving_id]);
		return $stmt->rowCount();
	}

	public function addETransfer()
	{
		date_default_timezone_set("America/Toronto");
		$this->time_sent = date("Y-m-d H:i:s");

		$stmt = $this->_connection->prepare("INSERT INTO Money_E_Transfer(Amount, Security_Question, Security_Answer_Hash, Message, Status, Time_Sent, Receiver_id, Sender_id) VALUES(:Amount, :Security_Question, :Security_Answer_Hash, :Message, :Status, :Time_Sent, :Receiver_id, :Sender_id)");
		$stmt->execute(['Amount'=>$this->amount, 'Security_Question'=>$this->security_question,'Security_Answer_Hash'=>$this->security_answer_hash, 'Message'=>$this->message, 'Status'=>$this->status, 'Time_Sent'=>$this->time_sent, 'Receiver_id'=>$this->receiver_id, 'Sender_id'=>$this->sender_id]);
		return $stmt->rowCount();
	}
}
?>

