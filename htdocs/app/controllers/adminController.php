<?php 

class AdminController extends Controller
{	
	public function index()
	{			
		if(isset($_SESSION['admin_id']))
		{
			if((int)$_SESSION['privileged_level'] == 1)
			{
				$this->view('adminLevel_1/index');	
			}

			else if((int)$_SESSION['privileged_level'] == 2)
			{
				$this->view('adminLevel_2/index');	
			}

			else if((int)$_SESSION['privileged_level'] == 3)
			{
				$this->view('adminLevel_3/index');	
			}		
		}	       
		else
		{
			header("location:/home/index");
		} 
	}


	//-------------------------- ADMIN LEVEL 1 PRIVILEGED  -------------------------// 

	public function listAllAdmin1()
	{
		if(!isset($_POST['action']))
		{
			$newAdmin = $this->model('Admin');
			$allAdmins = $newAdmin->showAllAdmin();
			$this->view('adminLevel_1/list_admin', ['admins' =>$allAdmins]);
		}

		else
		{
			$newAdmin = $this->model('Admin');
			$allAdmins = $newAdmin->showTheSearchedAdmin($_POST['username']);
			$this->view('adminLevel_1/list_admin', ['admins' =>$allAdmins]);
		}
	}

	public function listAllUser1()
	{	
		if(!isset($_POST['action']))
		{
			$newAdmin = $this->model('Admin');
			$allUsers = $newAdmin->showAllUser();
			$this->view('adminLevel_1/list_user', ['users' =>$allUsers]);
		}
		
		else
		{
			$newAdmin = $this->model('Admin');
			$allUsers = $newAdmin->showTheSearchedUser($_POST['username']);
			$this->view('adminLevel_1/list_user', ['users' =>$allUsers]);
		}
	}	

	public function listAllUserChequingAccount1()
	{	
		//Gets the client's username by his user_id.
		$theClient = $this->model('User');
		$theUser = $theClient->getUserFromId($_GET['User_id']);
		$_SESSION['client_username'] = $theUser->Username;


		//Gets all the client's chequing account
		$newAdmin = $this->model('Admin');
		$allCheckAcc = $newAdmin->showAllUserChequingAccount($_GET['User_id']);

		$this->view('adminLevel_1/list_user_chequing_account', ['chequingAccs' =>$allCheckAcc]);
	}	

	public function listAllUserSavingAccount1()
	{	
		//Gets the client's username by his user_id.
		$theClient = $this->model('User');
		$theUser = $theClient->getUserFromId($_GET['User_id']);
		$_SESSION['client_username'] = $theUser->Username;


		//Gets all the client's saving account
		$newAdmin = $this->model('Admin');
		$allSavingAcc = $newAdmin->showAllUserSavingAccount($_GET['User_id']);

		$this->view('adminLevel_1/list_user_saving_account', ['savingAccs' =>$allSavingAcc]);
	}	

	public function listAllUserInfo1()
	{	
		//Gets the client's username by his user_id.
		$theClient = $this->model('User');
		$theUser = $theClient->getUserFromId($_GET['User_id']);
		$_SESSION['client_username'] = $theUser->Username;

		//Gets all the client's general information
		$newAdmin = $this->model('Admin');
		$allInfo = $newAdmin->showAllInformation($_GET['User_id']);

		$this->view('adminLevel_1/list_user_info', ['userInfos' =>$allInfo]);
	}

	public function listAllContactInfo1()
	{	
		//Gets the client's username by his user_id.
		$theClient = $this->model('User');
		$theUser = $theClient->getUserFromId($_GET['User_id']);
		$_SESSION['client_username'] = $theUser->Username;

		//Gets all the client's general information
		$newAdmin = $this->model('Admin');
		$allInfo = $newAdmin->showAllContactInformation($_GET['User_id']);

		$this->view('adminLevel_1/list_user_contact_info', ['userContactInfos' =>$allInfo]);
	}

	 public function listTheUserChequingRecentTransaction1()
    {   
        $userModel = $this->model('User');

        //Gets all the client's contact information        
        $allChequingRecentTransaction = $userModel->getAllThisChequingRecentTransaction($_GET['User_Chequing_id']);

        $this->view('adminLevel_1/list_chequing_recent_transaction', ['chequingRecentTransactions' =>$allChequingRecentTransaction]);
    }

    public function listTheUserSavingRecentTransaction1()
    {   
        $userModel = $this->model('User');

        //Gets all the client's contact information        
        $allSavingRecentTransaction = $userModel->getAllThisSavingRecentTransaction($_GET['User_Saving_id']);

        $this->view('adminLevel_1/list_saving_recent_transaction', ['savingRecentTransactions' =>$allSavingRecentTransaction]);
    }

	public function registerAdmin()
	{
		$this->view('adminLevel_1/register_admin');

		if(isset($_POST['action']))
		{
			if($_POST['password_hash'] == $_POST['password_confirm'])
			{
				$newAdmin = $this->model('Admin');
				$newAdmin->username = $_POST['username'];
				$newAdmin->password_hash = password_hash($_POST['password_hash'], PASSWORD_DEFAULT);
				$newAdmin->privileged_level = $_POST['privileged_level_Option'];				
				$newAdmin->registerAdmin();
				header('location:/admin/listAllAdmin1'); 
			}

			//If password and confirm password do not match
			else
			{
				$this->view('admin/register_admin');
			}
		}
	}

	public function editUserInfo1()
	{	
		//Gets the client's username by his user_id.
		$theClient = $this->model('User');
		$theUser = $theClient->getUserFromId($_GET['User_id']);
		$_SESSION['client_username'] = $theUser->Username;

		//Gets all the client's general information
		$newAdmin = $this->model('Admin');
		$allInfo = $newAdmin->showAllInformation($_GET['User_id']);

		$this->view('adminLevel_1/edit_user_info', ['userInfos' =>$allInfo]);

	 	if(isset($_POST['action']))
        {
        	$theAdmin = $this->model('Admin');
        	$theAdmin->firstname = $_POST['firstname'];
            $theAdmin->lastname = $_POST['lastname'];
            $theAdmin->street_address = $_POST['street_address'];
            $theAdmin->city = $_POST['city'];
            $theAdmin->province = $_POST['province'];
            $theAdmin->zipcode = $_POST['zipcode'];
		    $theAdmin->updateUserInfo($_GET['User_id']);

            header("location:/admin/listAllUserInfo1?User_id=" .$_GET['User_id']);
        }
	}

	public function editUserContactInfo1()
	{	
		//Gets the client's username by his user_id.
		$theClient = $this->model('User');
		$theUser = $theClient->getUserFromId($_GET['User_id']);
		$_SESSION['client_username'] = $theUser->Username;

		//Get's the client's info
		$newAdmin = $this->model('Admin');
		$allInfo = $newAdmin->showAllContactInformation($_GET['User_id']);

		$this->view('adminLevel_1/edit_user_contact_info', ['userInfos' =>$allInfo]);

	 	if(isset($_POST['action']))
        {
        	$theAdmin = $this->model('Admin');
        	$theAdmin->type = $_POST['type'];
            $theAdmin->info = $_POST['info'];
		    $theAdmin->updateUserContactInfo($_GET['User_id']);

            header("location:/admin/listAllContactInfo1?User_id=" .$_GET['User_id']);
        }
	}

	public function editUserPassword1()
	{	
		$theUser = $this->model('Admin');
		$thisInfo = $theUser->getUserFromId($_GET['User_id']);
		$_SESSION['client_username'] = $thisInfo['Username'];

		$this->view('adminLevel_1/reset_user_password');

        if(isset($_POST['action']))
        {
            if($_POST['password_hash'] == $_POST['password_confirm'])
            {
                $client = $this->model('Admin');
                $client->password_hash = password_hash($_POST['password_hash'], PASSWORD_DEFAULT);
                $client->updateUserPassword($_GET['User_id']);

                header('location:/admin/listAllUser1'); 
            }

            //If both password input doesn't match
            else
            {   
                $this->view('adminLevel_1/reset_user_password');
            }
        }
    }

    public function editAdminPassword1()
	{	
		$theAdmin = $this->model('Admin');
		$thisInfo = $theAdmin->getAdminFromId($_GET['Admin_id']);
		$_SESSION['admin_username'] = $thisInfo['Username'];

		$this->view('adminLevel_1/reset_admin_password');

        if(isset($_POST['action']))
        {
            if($_POST['password_hash'] == $_POST['password_confirm'])
            {
                $admin = $this->model('Admin');
                $admin->password_hash = password_hash($_POST['password_hash'], PASSWORD_DEFAULT);
                $admin->updateAdminPassword($_GET['Admin_id']);

                header('location:/admin/listAllAdmin1'); 
            }

            //If both password input doesn't match
            else
            {   
                $this->view('adminLevel_1/reset_admin_password');
            }
        }
    }

    public function editUserActiveAccount1()
    {
    	$theAdmin = $this->model('Admin');
		$thisInfo = $theAdmin->getUserFromId($_GET['User_id']);
		$_SESSION['client_id'] = $thisInfo['User_id'];
		$_SESSION['client_username'] = $thisInfo['Username'];
		$_SESSION['active'] = $thisInfo['Active'];

		$this->view('adminLevel_1/edit_user_account_status');

        if(isset($_POST['action']))
        {
        	$client = $this->model('Admin');

            //If it's active           
            if($_SESSION['active'] == 1)
            {
            	//Deactivate
            	$client->active = false;
            }

            //If it's deactivated
            else
            {
            	//Reactivate
            	$client->active = true;
            }  
            $client->updateUserAccountStatus($_GET['User_id']);
            header('location:/admin/listAllUser1'); 
        }
    }

    public function deleteAdminAccount1()
    {
    	$theAdmin = $this->model('Admin');
		$thisInfo = $theAdmin->getAdminFromId($_GET['Admin_id']);
		$_SESSION['admin_username'] = $thisInfo['Username'];

		$this->view('adminLevel_1/delete_admin');

		if(isset($_POST['action']))
        {
        	$client = $this->model('Admin');
            $client->deleteAdminAccount($_GET['Admin_id']);
            header('location:/admin/listAllAdmin1'); 
        }
	}
	
	public function deleteUserAccount1()
	{
		$theAdmin = $this->model('Admin');
		$thisInfo = $theAdmin->getUserFromId($_GET['User_id']);
		$_SESSION['user_username'] = $thisInfo['Username'];

		$this->view('adminLevel_1/delete_user');

		if(isset($_POST['action']))
        {
        	$client = $this->model('Admin');
            $client->deleteUserAccount($_GET['User_id']);
            header('location:/admin/listAllUser1'); 
        }
	}



	//-------------------------- ADMIN LEVEL 2 PRIVILEGED  -------------------------// 
	public function listAllAdmin2()
	{
		$newAdmin = $this->model('Admin');
		$allAdmins = $newAdmin->showAllAdmin();

		$this->view('adminLevel_2/list_admin', ['admins' =>$allAdmins]);
	}

	public function listAllUser2()
	{	
		$newAdmin = $this->model('Admin');
		$allUsers = $newAdmin->showAllUser();

		$this->view('adminLevel_2/list_user', ['users' =>$allUsers]);
	}	

	public function listAllUserInfo2()
	{	
		//Gets the client's username by his user_id.
		$theClient = $this->model('User');
		$theUser = $theClient->getUserFromId($_GET['User_id']);
		$_SESSION['client_username'] = $theUser->Username;

		//Gets all the client's general information
		$newAdmin = $this->model('Admin');
		$allInfo = $newAdmin->showAllInformation($_GET['User_id']);

		$this->view('adminLevel_2/list_user_info', ['userInfos' =>$allInfo]);
	}


	public function listAllUserChequingAccount2()
	{	
		//Gets the client's username by his user_id.
		$theClient = $this->model('User');
		$theUser = $theClient->getUserFromId($_GET['User_id']);
		$_SESSION['client_username'] = $theUser->Username;


		//Gets all the client's chequing account
		$newAdmin = $this->model('Admin');
		$allCheckAcc = $newAdmin->showAllUserChequingAccount($_GET['User_id']);

		$this->view('adminLevel_2/list_user_chequing_account', ['chequingAccs' =>$allCheckAcc]);
	}	

	public function listAllUserSavingAccount2()
	{	
		//Gets the client's username by his user_id.
		$theClient = $this->model('User');
		$theUser = $theClient->getUserFromId($_GET['User_id']);
		$_SESSION['client_username'] = $theUser->Username;


		//Gets all the client's saving account
		$newAdmin = $this->model('Admin');
		$allSavingAcc = $newAdmin->showAllUserSavingAccount($_GET['User_id']);

		$this->view('adminLevel_2/list_user_saving_account', ['savingAccs' =>$allSavingAcc]);
	}	

	public function listAllRecentTransaction2()
	{	
		//Gets all the client's saving account
		$newAdmin = $this->model('Admin');
		$allRecentTransaction = $newAdmin->showAllRecentTransaction($_GET['User_id']);

		$this->view('adminLevel_2/list_user_recent_transaction', ['recentTrans' =>$allRecentTransaction]);
	}

	public function listAllContactInfo2()
	{	
		//Gets the client's username by his user_id.
		$theClient = $this->model('User');
		$theUser = $theClient->getUserFromId($_GET['User_id']);
		$_SESSION['client_username'] = $theUser->Username;

		//Gets all the client's general information
		$newAdmin = $this->model('Admin');
		$allInfo = $newAdmin->showAllContactInformation($_GET['User_id']);

		$this->view('adminLevel_2/list_user_contact_info', ['userContactInfos' =>$allInfo]);
	}

	public function editUserInfo2()
	{	
		//Gets the client's username by his user_id.
		$theClient = $this->model('User');
		$theUser = $theClient->getUserFromId($_GET['User_id']);
		$_SESSION['client_username'] = $theUser->Username;

		//Gets all the client's general information
		$newAdmin = $this->model('Admin');
		$allInfo = $newAdmin->showAllInformation($_GET['User_id']);

		$this->view('adminLevel_2/edit_user_info', ['userInfos' =>$allInfo]);

	 	if(isset($_POST['action']))
        {
        	$theAdmin = $this->model('Admin');
        	$theAdmin->firstname = $_POST['firstname'];
            $theAdmin->lastname = $_POST['lastname'];
            $theAdmin->street_address = $_POST['street_address'];
            $theAdmin->city = $_POST['city'];
            $theAdmin->province = $_POST['province'];
            $theAdmin->zipcode = $_POST['zipcode'];
		    $theAdmin->updateUserInfo($_GET['User_id']);

            header("location:/admin/listAllUserInfo2?User_id=" .$_GET['User_id']);
        }
	}

	public function editUserContactInfo2()
	{	
		//Gets the client's username by his user_id.
		$theClient = $this->model('User');
		$theUser = $theClient->getUserFromId($_GET['User_id']);
		$_SESSION['client_username'] = $theUser->Username;

		//Get's the client's info
		$newAdmin = $this->model('Admin');
		$allInfo = $newAdmin->showAllContactInformation($_GET['User_id']);

		$this->view('adminLevel_2/edit_user_contact_info', ['userInfos' =>$allInfo]);

	 	if(isset($_POST['action']))
        {
        	$theAdmin = $this->model('Admin');
        	$theAdmin->type = $_POST['type'];
            $theAdmin->info = $_POST['info'];
		    $theAdmin->updateUserContactInfo($_GET['User_id']);

            header("location:/admin/listAllContactInfo2?User_id=" .$_GET['User_id']);
        }
	}

	public function editUserPassword2()
	{	
		$theUser = $this->model('Admin');
		$thisInfo = $theUser->getUserFromId($_GET['User_id']);
		$_SESSION['client_username'] = $thisInfo['Username'];

		$this->view('adminLevel_2/reset_user_password');

        if(isset($_POST['action']))
        {
            if($_POST['password_hash'] == $_POST['password_confirm'])
            {
                $client = $this->model('Admin');
                $client->password_hash = password_hash($_POST['password_hash'], PASSWORD_DEFAULT);
                $client->updateUserPassword($_GET['User_id']);

                header('location:/admin/listAllUser2'); 
            }

            //If both password input doesn't match
            else
            {   
                $this->view('adminLevel_2/reset_user_password');
            }
        }
    }

    public function editAdminPassword2()
	{	
		$theAdmin = $this->model('Admin');
		$thisInfo = $theAdmin->getAdminFromId($_GET['Admin_id']);
		$_SESSION['admin_username'] = $thisInfo['Username'];

		$this->view('adminLevel_2/reset_admin_password');

        if(isset($_POST['action']))
        {
            if($_POST['password_hash'] == $_POST['password_confirm'])
            {
                $admin = $this->model('Admin');
                $admin->password_hash = password_hash($_POST['password_hash'], PASSWORD_DEFAULT);
                $admin->updateAdminPassword($_GET['Admin_id']);

                header('location:/admin/listAllAdmin2'); 
            }

            //If both password input doesn't match
            else
            {   
                $this->view('adminLevel_2/reset_admin_password');
            }
        }
    }

    public function editUserActiveAccount2()
    {
    	$theAdmin = $this->model('Admin');
		$thisInfo = $theAdmin->getUserFromId($_GET['User_id']);
		$_SESSION['client_id'] = $thisInfo['User_id'];
		$_SESSION['client_username'] = $thisInfo['Username'];
		$_SESSION['active'] = $thisInfo['Active'];

		$this->view('adminLevel_2/edit_user_account_status');

        if(isset($_POST['action']))
        {
        	$client = $this->model('Admin');

            //If it's active           
            if($_SESSION['active'] == 1)
            {
            	//Deactivate
            	$client->active = false;
            }

            //If it's deactivated
            else
            {
            	//Reactivate
            	$client->active = true;
            }  
            $client->updateUserAccountStatus($_GET['User_id']);
            header('location:/admin/listAllUser2'); 
        }
    }


	//-------------------------- ADMIN LEVEL 3 PRIVILEGED  -------------------------// 
	public function listAllAdmin3()
	{
		$newAdmin = $this->model('Admin');
		$allAdmins = $newAdmin->showAllAdmin();

		$this->view('adminLevel_3/list_admin', ['admins' =>$allAdmins]);
	}

	public function listAllUser3()
	{	
		$newAdmin = $this->model('Admin');
		$allUsers = $newAdmin->showAllUser();

		$this->view('adminLevel_3/list_user', ['users' =>$allUsers]);
	}	

	public function listAllUserChequingAccount3()
	{	
		//Gets the client's username by his user_id.
		$theClient = $this->model('User');
		$theUser = $theClient->getUserFromId($_GET['User_id']);
		$_SESSION['client_username'] = $theUser->Username;


		//Gets all the client's chequing account
		$newAdmin = $this->model('Admin');
		$allCheckAcc = $newAdmin->showAllUserChequingAccount($_GET['User_id']);

		$this->view('adminLevel_3/list_user_chequing_account', ['chequingAccs' =>$allCheckAcc]);
	}	

	public function listAllUserSavingAccount3()
	{	
		//Gets the client's username by his user_id.
		$theClient = $this->model('User');
		$theUser = $theClient->getUserFromId($_GET['User_id']);
		$_SESSION['client_username'] = $theUser->Username;


		//Gets all the client's saving account
		$newAdmin = $this->model('Admin');
		$allSavingAcc = $newAdmin->showAllUserSavingAccount($_GET['User_id']);

		$this->view('adminLevel_3/list_user_saving_account', ['savingAccs' =>$allSavingAcc]);
	}	

	public function listAllRecentTransaction3()
	{	
		//Gets all the client's saving account
		$newAdmin = $this->model('Admin');
		$allRecentTransaction = $newAdmin->showAllRecentTransaction($_GET['User_id']);

		$this->view('adminLevel_3/list_user_recent_transaction', ['recentTrans' =>$allRecentTransaction]);
	}

	public function listAllUserInfo3()
	{	
		//Gets the client's username by his user_id.
		$theClient = $this->model('User');
		$theUser = $theClient->getUserFromId($_GET['User_id']);
		$_SESSION['client_username'] = $theUser->Username;

		//Gets all the client's general information
		$newAdmin = $this->model('Admin');
		$allInfo = $newAdmin->showAllInformation($_GET['User_id']);

		$this->view('adminLevel_3/list_user_info', ['userInfos' =>$allInfo]);
	}

	public function listAllContactInfo3()
	{	
		//Gets the client's username by his user_id.
		$theClient = $this->model('User');
		$theUser = $theClient->getUserFromId($_GET['User_id']);
		$_SESSION['client_username'] = $theUser->Username;

		//Gets all the client's general information
		$newAdmin = $this->model('Admin');
		$allInfo = $newAdmin->showAllContactInformation($_GET['User_id']);

		$this->view('adminLevel_3/list_user_contact_info', ['userContactInfos' =>$allInfo]);
	}

    public function logout()
    {
        session_destroy();
        header('location:/home/login');
    }
}
?>
