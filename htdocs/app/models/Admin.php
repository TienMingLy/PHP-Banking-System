<?php

class Admin extends Model  //user is sub-class of database
{
	public $user_id;
	public $admin_id;
	public $username;
	public $password_hash;
	public $privileged_level;
	public $last_login_date;
	public $account_id;	
	public $active;

	//User Information
	public $firstname;
	public $lastname;
	public $street_address;
	public $city;
	public $province;
	public $zipcode;

	public function getAdmin($username)
	{
		$stmt = $this->_connection->prepare("SELECT * FROM Administrator WHERE username LIKE :username");
		$stmt->execute(['username'=>$username]);
		$stmt->setFetchMode(PDO::FETCH_CLASS, "Admin"); //datatype user
		return $stmt->fetch(); //it should return an admin
	}
	
	public function getUserFromId($user_id)
	{
		$stmt = $this->_connection->prepare("SELECT * FROM User WHERE user_id LIKE :user_id");
		$stmt->execute(['user_id'=>$user_id]);
		$stmt->setFetchMode(PDO::FETCH_CLASS, "User"); //datatype user
		return $stmt->fetch(); //it should return a user
	}

	public function getAdminFromId($admin_id)
	{
		$stmt = $this->_connection->prepare("SELECT * FROM Administrator WHERE admin_id LIKE :admin_id");
		$stmt->execute(['admin_id'=>$admin_id]);
		$stmt->setFetchMode(PDO::FETCH_CLASS, "User"); //datatype user
		return $stmt->fetch(); //it should return a user
	}
	
	public function getUsernameFromId($user_id)
	{
		$stmt = $this->_connection->prepare("SELECT Username FROM User WHERE user_id LIKE :user_id");
		$stmt->execute(['user_id'=>$user_id]);
		$stmt->setFetchMode(PDO::FETCH_CLASS, "User"); //datatype user
		return $stmt->fetch(); //it should return an user
	}

	public function updateAdminLastLogin()
	{
		date_default_timezone_set("America/Toronto");
		$this->last_login_date = date("Y-m-d H:i:s");

		$stmt = $this->_connection->prepare("UPDATE Administrator SET Last_Login_Date = :Last_Login_Date WHERE Admin_id = '".$_SESSION['admin_id']."';");
		$stmt->execute(['Last_Login_Date'=>$this->last_login_date]);
		return $stmt->rowCount(); 
	}

	public function registerAdmin()
	{
		$stmt = $this->_connection->prepare("INSERT INTO Administrator(Username, Password_Hash, Privileged_Level) VALUES(:Username, :Password_Hash, :Privileged_Level)");
		$stmt->execute(['Username'=>$this->username, 'Password_Hash'=>$this->password_hash, 'Privileged_Level'=>$this->privileged_level]);	
		return $stmt->rowCount();
	}

	/*---------------------------------------SHOW EVERYTHING------------------------------------------- */
	/*--------------------------------------------------------------------------------------------------*/
	public function showAllAdmin()
	{
		$stmt = $this->_connection->prepare("SELECT * FROM Administrator ORDER BY Privileged_Level");
		$stmt->execute();
		return $results = $stmt->fetchAll();
	}	

	public function showAllUser()
	{
		$stmt = $this->_connection->prepare("SELECT * FROM User ORDER BY Username");
		$stmt->execute();
		return $results = $stmt->fetchAll();
	}

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

	public function showAllInformation($user_id)
	{
		$stmt = $this->_connection->prepare("SELECT * FROM User_Info WHERE User_id LIKE :user_id");
		$stmt->execute(['user_id'=>$user_id]);
		return $results = $stmt->fetchAll();
	}

	public function showAllContactInformation($user_id)
	{
		$stmt = $this->_connection->prepare("SELECT * FROM User_Contact_Info WHERE User_id LIKE :user_id");
		$stmt->execute(['user_id'=>$user_id]);
		return $results = $stmt->fetchAll();
	}

	public function showAllChequingRecentTransaction($user_chequing_id)
	{
		$stmt = $this->_connection->prepare('SELECT * FROM Chequing_Recent_Transaction WHERE User_Chequing_id = ?
											 ORDER BY Transaction_Timestamp DESC' );
		$stmt->execute(array($user_chequing_id));		
		return $results = $stmt->fetchAll(); 	
	}

	public function showAllSavingRecentTransaction($user_saving_id)
	{
		$stmt = $this->_connection->prepare('SELECT * FROM Saving_Recent_Transaction WHERE User_Saving_id = ?
											 ORDER BY Transaction_Timestamp DESC' );
		$stmt->execute(array($user_saving_id));			
		return $results = $stmt->fetchAll(); 	
	}

	/*-----------------------------------------  UPDATE ----------------------------------------------- */
	/*--------------------------------------------------------------------------------------------------*/
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

	public function updateUserPassword($user_id)
	{
		$stmt = $this->_connection->prepare("UPDATE User SET Password_Hash = :Password_Hash WHERE User_id = '".$user_id."';");
		$stmt->execute(['Password_Hash'=>$this->password_hash]);
		return $stmt->rowCount(); 
	}

	public function updateAdminPassword($admin_id)
	{
		$stmt = $this->_connection->prepare("UPDATE Administrator SET Password_Hash = :Password_Hash WHERE admin_id = '".$admin_id."';");
		$stmt->execute(['Password_Hash'=>$this->password_hash]);
		return $stmt->rowCount(); 
	}

	public function updateUserAccountStatus($user_id)
	{
		$stmt = $this->_connection->prepare("UPDATE User SET Active = :Active WHERE User_id = '".$user_id."';");
		$stmt->execute(['Active'=>$this->active]);
		return $stmt->rowCount(); 
	}

	/*-----------------------------------------  DELETE ----------------------------------------------- */
	/*--------------------------------------------------------------------------------------------------*/

	public function deleteAdminAccount($admin_id)
	{
		$stmt = $this->_connection->prepare("DELETE FROM Administrator WHERE Admin_id LIKE :Admin_id");
		$stmt->execute(['Admin_id'=>$admin_id]);
		return $stmt->rowCount(); 
	}

	public function deleteUserCredential($user_id)
	{
		$stmt = $this->_connection->prepare("DELETE FROM User WHERE User_id LIKE :User_id");
		$stmt->execute(['User_id'=>$user_id]);
		return $stmt->rowCount(); 
	}	

}
?>