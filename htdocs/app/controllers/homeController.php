<?php

class HomeController extends Controller
{
	public function index()
	{
		//session_destroy();

		//If user is found, but the account is deactivated
		if(isset($_SESSION['user_id']) && $_SESSION['account_active'] == 0)
		{
			$this->view('user/reactivate_user');

			if(isset($_POST['action']))
            {
            	session_destroy();
        		header('location:/home/login');
            }
		}		

		//If user is found, but the account is active
		else if(isset($_SESSION['user_id']) && (int)$_SESSION['account_active'] == 1)
		{
			$UserModel = $this->model('User');
			$allChequingAcc = $UserModel->showAllUserChequingAccount($_SESSION['user_id']);
			$allSavingAcc = $UserModel->showAllUserSavingAccount($_SESSION['user_id']);

			$this->view('home/index', ['chequing' =>$allChequingAcc, 'saving' =>$allSavingAcc]);
		} 

		//Admin Level One
		else if(isset($_SESSION['admin_id']) && (int)$_SESSION['privileged_level'] == 1)
		{
			$this->view('adminLevel_1/index');	
		}

		//Admin Level Two
		else if(isset($_SESSION['admin_id']) && (int)$_SESSION['privileged_level'] == 2)
		{
			$this->view('adminLevel_2/index');	
		}

		//Admin Level Three
		else if(isset($_SESSION['admin_id']) && (int)$_SESSION['privileged_level'] == 3)
		{
			$this->view('adminLevel_3/index');	
		}	

		else
		{
			$this->view('home/welcome');	
		}
	}

	public function logout()
    {
        session_destroy();
        header('location:/home/login');
    }
}