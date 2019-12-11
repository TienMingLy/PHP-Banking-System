<?php
class UserController extends Controller
{
    public function index()
    {
        header('location:/home/index');
    }

    public function account_reactivate()
    {                
        //Supposed to rng a security question
        $this->view('user/reactivate_user');   
    }

    public function updateAccountStatus()
    {
        $this->view('user/edit_user_account_status');

        if(isset($_POST['action']))
        {
            $user = $this->model('User');
            $user->active = false;
            $user->updateUserAccountStatus($_SESSION['user_id']);
            header('location:/home/logout');
        }
    }

    public function login()
    {
        if(empty($_SESSION['user_id']) || empty($_SESSION['admin_id']))
        {
            $this->view('user/login');

            if(isset($_POST['action']))
            {
            	//Checks the User
                $user = $this->model('User');
                $theUser = $user->getUser($_POST['username']);

                //Checks the Admin
                $admin = $this->model('Admin');
                $theAdmin = $admin->getAdmin($_POST['username']);            

                //Checks if it is the User credential
                if($theUser && password_verify($_POST['password_hash'], $theUser->Password_Hash))
                {
                    $_SESSION['user_id'] = $theUser->User_id;
                    $_SESSION['username'] = $theUser->Username;
                    $_SESSION['account_active'] = $theUser->Active;

                    //Update the last login timestamp
                    $user->updateUserLastLogin();
                    header('location:/home/index');
                }
                
                //Checks if it is an Admin credential
                else if($theAdmin && password_verify($_POST['password_hash'], $theAdmin->Password_Hash))
                {
                	$_SESSION['admin_id'] = $theAdmin->Admin_id;
                	$_SESSION['username'] = $theAdmin->Username;                
                    $_SESSION['privileged_level'] = $theAdmin->Privileged_Level;
                    
                    //Update the last login timestamp
                    $theAdmin->updateAdminLastLogin();
                	header('location:/admin/index');
                }

                //Log again if user and admin are NOT found
                else
                {
                    $this->view('user/login');
                }
            }
        }

        //Already logged in
        else if (!empty($_SESSION['user_id'] && empty($_SESSION['admin_id'])))
        {
            header('location:/home/index');
        }

        else if(!empty($_SESSION['admin_id'] && empty($_SESSION['user_id'])))
        {
            header('location:/admin/index');
        }

    }

    /* Registration */
    public function register()
    {
        if(!isset($_SESSION['user_id']))
        {
            $this->view('user/register_user');

            if(isset($_POST['action']))
            {
                if($_POST['password_hash'] == $_POST['password_confirm'])
                {
                    $user = $this->model('User');
                    $user->username = $_POST['username'];
                    $user->password_hash = password_hash($_POST['password_hash'], PASSWORD_DEFAULT);
                    $user->addUser();

                    //Create a session as soon the user is created
                    $theUser = $user->getUser($_POST['username']);
                    $_SESSION['user_id'] = $theUser->User_id;
               
                    header('location:/user/registerInfo'); 
                }

                else
                {   
                    $this->view('user/register_user');
                }
            }
        }
    }

    public function registerInfo()
    {
        $this->view('user/register_user_info');

        if(isset($_POST['action']))
        {            
            $user = $this->model('User');
            $user->firstname = $_POST['firstname'];
            $user->lastname = $_POST['lastname'];
            $user->street_address = $_POST['street_address'];
            $user->city = $_POST['city'];
            $user->province = $_POST['province'];
            $user->zipcode = $_POST['zipcode'];
            $user->addUserInfo();
                      
            header('location:/user/registerContactInfo'); 
        }

        else
        {
            $this->view('user/register_user_info');
        }
    }

    public function registerContactInfo()
    {
        $this->view('user/register_user_contact_info');

        if(isset($_POST['action']))
        {
            $user = $this->model('User');
            $user->type = $_POST['type'];
            $user->info = $_POST['info'];
            $user->addUserContactInfo();
                      
            header('location:/user/registerSecurityQuestion'); 
        }
    }

    public function registerSecurityQuestion()
    {
        $this->view('user/register_user_security_question');

        if(isset($_POST['action']))
        {
            $user = $this->model('User');
            $user->question = $_POST['question'];
            $user->answer_hash = password_hash($_POST['answer_hash'], PASSWORD_DEFAULT);
            $user->addUserSecurityQuestion();
                      
            unset($_SESSION['user_id']);
            
            header('location:/user/login');
        }

        else
        {
            $this->view('user/register_user_security_question');
        }
    }

    public function registerNewBankAccount()
    {
        $this->view('user/register_bank_account');

        if(isset($_POST['action']))
        {
            if($_POST['account_type_Option'] == "chequing")
            {
                $user = $this->model('User');
                $user->account_name = $_POST['account_name'];
                $user->amount = $_POST['amount'];
                $user->addChequingAccount();

                //Get the chequing id
                $bankModel = $this->model('User');
                $theBankAccount = $bankModel->getTheChequingAccount($_POST['account_name']);

                $toTransaction = $this->model('User');  
                $toTransaction->amount = $_POST['amount'];
                $toTransaction->transaction_type = "First Time Deposit";
                $toTransaction->user_chequing_id = $theBankAccount['User_Chequing_id'];
                $toTransaction->addChequingRecentTransaction();
                
                header('location:/home/index');
                
            }

            else if($_POST['account_type_Option'] == "saving")
            {
                $user = $this->model('User');
                $user->account_name = $_POST['account_name'];
                $user->amount = $_POST['amount'];
                $user->addSavingAccount();

                //Get the saving id
                $bankModel = $this->model('User');
                $theBankAccount = $bankModel->getTheSavingAccount($_POST['account_name']);

                $toTransaction = $this->model('User');  
                $toTransaction->amount = $_POST['amount'];
                $toTransaction->transaction_type = "First Time Deposit";
                $toTransaction->user_saving_id = $theBankAccount['User_Saving_id'];
                $toTransaction->addSavingRecentTransaction();

                header('location:/home/index');
            }
        }

        else
        {
            $this->view('user/register_bank_account');
        }
    }

    /*---------------------------------------------SHOW USER'S DESIRED INFO----------------------------------------------*/
    /*-------------------------------------------------------------------------------------------------------------------*/
    public function listTheUserInfo()
    {   
        //Gets the client's username by his user_id.
        $userModel = $this->model('User');

        //Gets all the client's general information        
        $allInfo = $userModel->getAllUserInfo($_SESSION['user_id']);

        $this->view('user/list_user_info', ['userInfos' =>$allInfo]);
    }

    public function listTheUserContactInfo()
    {   
        //Gets the client's username by his user_id.
        $userModel = $this->model('User');

        //Gets all the client's contact information        
        $allContactInfo = $userModel->getAllUserContactInfo($_SESSION['user_id']);

        $this->view('user/list_user_contact_info', ['userContactInfos' =>$allContactInfo]);
    }

    public function listTheUserSecurityQuestion()
    {   
        //Gets the client's username by his user_id.
        $userModel = $this->model('User');

        //Gets all the client's contact information        
        $allSecurityQuestions = $userModel->getAllSecurityQuestion($_SESSION['user_id']);

        $this->view('user/list_user_security_question', ['userSecurityQuestions' =>$allSecurityQuestions]);
    }

    public function listTheUserChequingRecentTransaction()
    {   
        $userModel = $this->model('User');

        //Gets all the client's contact information        
        $allChequingRecentTransaction = $userModel->getAllThisChequingRecentTransaction($_GET['User_Chequing_id']);

        $this->view('user/list_chequing_recent_transaction', ['chequingRecentTransactions' =>$allChequingRecentTransaction]);
    }

    public function listTheUserSavingRecentTransaction()
    {   
        $userModel = $this->model('User');

        //Gets all the client's contact information        
        $allSavingRecentTransaction = $userModel->getAllThisSavingRecentTransaction($_GET['User_Saving_id']);

        $this->view('user/list_saving_recent_transaction', ['savingRecentTransactions' =>$allSavingRecentTransaction]);
    }

    
    /*-------------------------------------------------------EDIT INFORMATION-------------------------------------------*/
    /*------------------------------------------------------------------------------------------------------------------*/
    public function editUserInfo()
    {   
        //Gets the client's username by his user_id.
        $userModel = $this->model('User');
        $allInfo = $userModel->getAllUserInfo($_SESSION['user_id']);

        $this->view('user/edit_user_info', ['userInfos' =>$allInfo]);

        if(isset($_POST['action']))
        {
            $theEditedUserModel = $this->model('User');
            $theEditedUserModel->firstname = $_POST['firstname'];
            $theEditedUserModel->lastname = $_POST['lastname'];
            $theEditedUserModel->street_address = $_POST['street_address'];
            $theEditedUserModel->city = $_POST['city'];
            $theEditedUserModel->province = $_POST['province'];
            $theEditedUserModel->zipcode = $_POST['zipcode'];
            $theEditedUserModel->updateUserInfo($_SESSION['user_id']);
            header("location:/user/listTheUserInfo");
        }
    }

    public function editUserContactInfo()
    {   
        //Gets the client's username by his user_id.
        $userModel = $this->model('User');
        $allInfo = $userModel->getAllUserContactInfo($_SESSION['user_id']);

        $this->view('user/edit_user_contact_info', ['userContactInfos' =>$allInfo]);

        if(isset($_POST['action']))
        {
            $theEditedUserModel = $this->model('User');
            $theEditedUserModel->type = $_POST['type'];
            $theEditedUserModel->info = $_POST['info'];
            $theEditedUserModel->updateUserContactInfo($_SESSION['user_id']);

            header("location:/user/listTheUserContactInfo");
        }
    }

    public function editUserPassword()
    {   
        $userModel = $this->model('User');
        $thisInfo = $userModel->getUserFromId($_SESSION['user_id']);

        $this->view('user/change_user_password');

        if(isset($_POST['action']))
        {
            if(password_verify($_POST['old_password_hash'], $thisInfo->Password_Hash))
            {
                 if($_POST['new_password_hash'] == $_POST['new_password_confirm'])
                {
                    $theEditedUserModel = $this->model('User');
                    $theEditedUserModel->password_hash = password_hash($_POST['new_password_hash'], PASSWORD_DEFAULT);
                    $theEditedUserModel->updateUserPassword($_SESSION['user_id']);

                    header('location:/home/index'); 
                }

                //If both password input doesn't match
                else
                {   
                    $this->view('user/change_user_password');
                }
            }

            //If new passwords doesn't match
            else
            {
                $this->view('user/change_user_password');
            }
        }
    }

    public function transferBetweenAccount()
    {
        $UserModel = $this->model('User');
        $allChequingAcc = $UserModel->showAllUserChequingAccount($_SESSION['user_id']);
        $allSavingAcc = $UserModel->showAllUserSavingAccount($_SESSION['user_id']);

        if(!isset($_POST['action']))
        {
            $this->view('user/transfer_between_account', ['chequing' =>$allChequingAcc, 'saving' =>$allSavingAcc]);
        }

        else
        {
            $UserModel = $this->model('User');

            //From Account
            $fromChequingAccount = $UserModel->getTheTransferChequingAccount($_POST['sender_Option']);
            $fromSavingAccount = $UserModel->getTheTransferSavingAccount($_POST['sender_Option']);

            //To Account
            $toChequingAccount = $UserModel->getTheTransferChequingAccount($_POST['receiver_Option']);
            $toSavingAccount = $UserModel->getTheTransferSavingAccount($_POST['receiver_Option']);

            //From Chequing to Chequing
            if(($fromChequingAccount == true && $toChequingAccount == true) && ($fromSavingAccount == false && $toSavingAccount == false))
            {
                //If input amount is higher than the chequing account
                if($_POST['amount'] > $fromChequingAccount['Amount'])
                {
                    echo "Your input of $".$_POST['amount']." is higher than the current chequing account of $".$fromChequingAccount['Amount'].".";
                }


                else if($fromChequingAccount == $toChequingAccount)
                {
                    echo "You can not transfer between the same account";
                }
                
                else
                {
                    $fromUserModel = $this->model('User');
                    $fromUserModel->amount = ($fromChequingAccount['Amount'] - $_POST['amount']);
                    $fromUserModel->updateChequingAccountAmount($_POST['sender_Option']);

                    $toUserModel = $this->model('User');
                    $toUserModel->amount = ($toChequingAccount['Amount'] + $_POST['amount']);
                    $toUserModel->updateChequingAccountAmount($_POST['receiver_Option']);

                    //Register the Sender transaction(Chequing)
                    $fromTransaction = $this->model('User');
                    $fromTransaction->amount = $_POST['amount'];
                    $fromTransaction->transaction_type = "Transfer from ".$fromChequingAccount['Account_Name']."";
                    $fromTransaction->user_chequing_id = $_POST['sender_Option'];
                    $fromTransaction->addChequingRecentTransaction();

                    //Register the Receiver transaction(Chequing) 
                    $toTransaction = $this->model('User');  
                    $toTransaction->amount = $_POST['amount'];
                    $toTransaction->transaction_type = "Transfer to ".$toChequingAccount['Account_Name'];
                    $toTransaction->user_chequing_id = $_POST['receiver_Option'];
                    $toTransaction->addChequingRecentTransaction();
                    header('location:/home/index');   
                }
            }

            //From Saving to Saving
            else if(($fromSavingAccount == true && $toSavingAccount == true) && ($fromChequingAccount == false && $toChequingAccount == false))
            {
                //If input amount is higher than the saving account
                if($_POST['amount'] > $fromSavingAccount['Amount'])
                {   
                    echo "Your input of $".$_POST['amount']." is higher than the current chequing account of $".$fromSavingAccount['Amount'].".";
                }

                else if($fromSavingAccount == $toSavingAccount)
                {
                    echo "You can not transfer between the same account";
                }
                
                else
                {
                    $fromUserModel = $this->model('User');
                    $fromUserModel->amount = ($fromSavingAccount['Amount'] - $_POST['amount']);
                    $fromUserModel->updateSavingAccountAmount($_POST['sender_Option']);

                    $toUserModel = $this->model('User');
                    $toUserModel->amount = ($toSavingAccount['Amount'] + $_POST['amount']);
                    $toUserModel->updateSavingAccountAmount($_POST['receiver_Option']);

                    //Register the Sender transaction(Saving)
                    $fromTransaction = $this->model('User');
                    $fromTransaction->amount = $_POST['amount'];
                    $fromTransaction->transaction_type = "Transfer from ".$fromSavingAccount['Account_Name']."";
                    $fromTransaction->user_saving_id = $_POST['sender_Option'];
                    $fromTransaction->addSavingRecentTransaction(); 

                    //Register the Receiver transaction(Saving)
                    $toTransaction = $this->model('User');
                    $toTransaction->amount = $_POST['amount'];
                    $toTransaction->transaction_type = "Transfer to ".$toSavingAccount['Account_Name']."";
                    $toTransaction->user_saving_id = $_POST['receiver_Option'];
                    $toTransaction->addSavingRecentTransaction();         
                    header('location:/home/index');    
                }
            }            

            //From Chequing to Saving
            else if(($fromChequingAccount == true && $toSavingAccount == true) && ($fromSavingAccount == false && $toChequingAccount == false))
            {
                //If input amount is higher than the chequing account
                if($_POST['amount'] > $fromChequingAccount['Amount'])
                {
                    echo "Your input of $".$_POST['amount']." is higher than the current chequing account of $".$fromChequingAccount['Amount'].".";
                }
                
                else
                {
                    $fromUserModel = $this->model('User');
                    $fromUserModel->amount = ($fromChequingAccount['Amount'] - $_POST['amount']);
                    $fromUserModel->updateChequingAccountAmount($_POST['sender_Option']);

                    $toUserModel = $this->model('User');
                    $toUserModel->amount = ($toSavingAccount['Amount'] + $_POST['amount']);
                    $toUserModel->updateSavingAccountAmount($_POST['receiver_Option']);

                    //Register the Sender transaction(chequing) 
                    $fromTransaction = $this->model('User');
                    $fromTransaction->amount = $_POST['amount'];
                    $fromTransaction->transaction_type = "Transfer to ".$toSavingAccount['Account_Name']."";
                    $fromTransaction->user_chequing_id = $_POST['sender_Option'];
                    $fromTransaction->addChequingRecentTransaction();

                    //Register the Receiver transaction(saving)
                    $toTransaction = $this->model('User');
                    $toTransaction->amount = $_POST['amount'];
                    $toTransaction->transaction_type = "Transfer from ".$fromChequingAccount['Account_Name']."";
                    $toTransaction->user_saving_id = $_POST['receiver_Option'];
                    $toTransaction->addSavingRecentTransaction(); 
                    header('location:/home/index');   
                }
            }

            //From Saving to Chequing
            else if(($fromSavingAccount == true && $toChequingAccount == true) && ($fromChequingAccount == false && $toSavingAccount == false))
            {
                //If input amount is higher than the saving account
                if($_POST['amount'] > $fromSavingAccount['Amount'])
                {
                    echo "Your input of $".$_POST['amount']." is higher than the current chequing account of $(".$fromSavingAccount['Amount'].").";
                }
                
                else
                {
                    $fromUserModel = $this->model('User');
                    $fromUserModel->amount = ($fromSavingAccount['Amount'] - $_POST['amount']);
                    $fromUserModel->updateSavingAccountAmount($_POST['sender_Option']);

                    $toUserModel = $this->model('User');
                    $toUserModel->amount = ($toChequingAccount['Amount'] + $_POST['amount']);
                    $toUserModel->updateChequingAccountAmount($_POST['receiver_Option']);

                    //Register the Sender transaction(saving)
                    $fromTransaction = $this->model('User');
                    $fromTransaction->amount = $_POST['amount'];
                    $fromTransaction->transaction_type = "Transfer to ".$toChequingAccount['Account_Name']."";
                    $fromTransaction->user_saving_id = $_POST['sender_Option'];
                    $fromTransaction->addSavingRecentTransaction(); 

                    //Register the Receiver transaction(chequing) 
                    $toTransaction = $this->model('User');
                    $toTransaction->amount = $_POST['amount'];

                    $toTransaction->transaction_type = "Transfer from ".$fromSavingAccount['Account_Name']."";
                    $toTransaction->user_chequing_id = $_POST['receiver_Option'];
                    $toTransaction->addChequingRecentTransaction();  

                    $toTransaction->transaction_type = "Transfer to ".$toChequingAccount['Account_Name']."";
                    $toTransaction->user_chequing_id = $_POST['sender_Option'];
                    $toTransaction->addSavingRecentTransaction();
                    header('location:/home/index');   
                }
            }

            else
            {
                $this->view('user/transfer_between_account', ['chequing' =>$allChequingAcc, 'saving' =>$allSavingAcc]); 
            }
        }
    }

    public function e_transfer()
    {
        $UserModel = $this->model('User');
        $allChequingAcc = $UserModel->showAllUserChequingAccount($_SESSION['user_id']);
        $allSavingAcc = $UserModel->showAllUserSavingAccount($_SESSION['user_id']);

        $this->view('user/create_e_transfer', ['chequing' =>$allChequingAcc, 'saving' =>$allSavingAcc]);

        if(isset($_POST['action']))
        {
            $theUserModel = $this->model('User');
            $theRecipient = $theUserModel->getUser($_POST['username']);

            $theAccountModel = $this->model('User');
            $theChequingBankAccount = $theAccountModel->getTheTransferChequingAccount($_POST['from_Option']); 
            $theSavingBankAccount = $theAccountModel->getTheTransferSavingAccount($_POST['from_Option']); 

            if($_SESSION['username'] == $_POST['username'])
            {
                echo "You can not e-transfer yourself.";
                echo "<br/>";
            }

            else if(empty($theRecipient))
            {
                echo "The recipient ".$_POST['username']." has not been found.";
                echo "<br/>";
            }

            else if(($theChequingBankAccount == true && $theSavingBankAccount == false) && ($_POST['amount'] > $theChequingBankAccount['Amount']))
            {
                echo "Your amount of $".$_POST['amount']." is greater than your chequing balance($".$theChequingBankAccount['Amount'].")";
                echo "<br/>";                                      
            }

            else if(($theChequingBankAccount == false && $theSavingBankAccount == true) && ($_POST['amount'] > $theSavingBankAccount['Amount']))
            {                
                $this->view('user/create_e_transfer', ['chequing' =>$allChequingAcc, 'saving' =>$allSavingAcc]);
                echo "<br/>";
            }

            else if(($theSavingBankAccount == true && $theChequingBankAccount == false) && ($_POST['amount'] > $theSavingBankAccount['Amount']))
            {
                echo "Your amount of $".$_POST['amount']." is greater than your saving balance($".$theSavingBankAccount['Amount'].")";
                echo "<br/>";
            }
                    
            else
            {
                //E-Transfer
                $eTransfer = $this->model('User');
                $eTransfer->amount = $_POST['amount'];
                $eTransfer->security_question = $_POST['security_question'];
                $eTransfer->security_answer_hash = password_hash($_POST['answer_hash'], PASSWORD_DEFAULT);

                if(empty($_POST['message'])) 
                {
                    $eTransfer->message ="No Message";    
                }
                
                else
                {
                    $eTransfer->message = $_POST['message'];
                }

                $eTransfer->status = "Pending";
                $eTransfer->receiver_id = $theRecipient->User_id;
                $eTransfer->sender_id = $_SESSION['user_id'];
                $eTransfer->addETransfer();

                //Saving into Recent Transaction(Chequing or Saving)
                $toTransaction = $this->model('User');
                $toTransaction->amount = $_POST['amount'];
                $toTransaction->transaction_type = "E-Transfer to ".$_POST['username']."";

                //Update bank account amount
                $updateBankAccount = $this->model('User');

                //If it's from a chequing account
                if($theChequingBankAccount == true && $theSavingBankAccount == false)
                {

                    $updateBankAccount->amount = ($theChequingBankAccount['Amount'] - $_POST['amount']);
                    $updateBankAccount->updateChequingAccountAmount($_POST['from_Option']);

                    $toTransaction->user_chequing_id = $_POST['from_Option'];
                    $toTransaction->addChequingRecentTransaction();
                }

                //If it's from a saving account
                else if($theChequingBankAccount == false && $theSavingBankAccount == true)
                {
                    $updateBankAccount->amount = ($theSavingBankAccount['Amount'] - $_POST['amount']);
                    $updateBankAccount->updateSavingAccountAmount($_POST['from_Option']);

                    $toTransaction->user_saving_id = $_POST['from_Option'];
                    $toTransaction->addSavingRecentTransaction();
                }
                header('location:/user/list_e_transfer_sent');
            }
        }

        else
        {
            $this->view('user/create_e_transfer', ['chequing' =>$allChequingAcc, 'saving' =>$allSavingAcc]);
        }
    }


    public function list_e_transfer_sent()
    {
        $UserModel = $this->model('User');
        $allETransferSent = $UserModel->showAllETransferSent($_SESSION['user_id']);

        $this->view('user/list_e_transfer_sent', ['e_transfer_sent' =>$allETransferSent]);
    }

    public function list_e_transfer_received()
    {
        $UserModel = $this->model('User');
        $allETransferReceived = $UserModel->showAllETransferReceived($_SESSION['user_id']);

        $this->view('user/list_e_transfer_received', ['e_transfer_received' =>$allETransferReceived]);
    }

    public function accept_e_transfer()
    {
        $userModel = $this->model('User');
        $theETransferData = $userModel->getTheETransfer($_GET['Money_Transfer_id']);
        $security_answer = $userModel->getTheETransferInfo($_GET['Money_Transfer_id'])['Security_Answer_Hash'];
        $amountReceived = $userModel->getTheETransferInfo($_GET['Money_Transfer_id'])['Amount'];

        $theChequingAccount = $userModel->showAllUserChequingAccount($_SESSION['user_id']);
        $theSavingAccount = $userModel->showAllUserSavingAccount($_SESSION['user_id']);

        $this->view('user/accept_e_transfer', ['e_transfer_data' =>$theETransferData,'chequing_account' => $theChequingAccount,'saving_account' => $theSavingAccount]);

        if(isset($_POST['action']))
        {
            if($theETransferData && (password_verify($_POST['answer_hash'], $security_answer)))
            {
                //Update e-transfer status
                $eTransferUpdate = $this->model('User');
                $eTransferUpdate->status = "Accepted";
                $eTransferUpdate->updateETransferStatus($_GET['Money_Transfer_id']);

                $theAccountModel = $this->model('User');
                $theChequingBankAccount = $theAccountModel->getTheTransferChequingAccount($_POST['to_Option']); 
                $theSavingBankAccount = $theAccountModel->getTheTransferSavingAccount($_POST['to_Option']); 

                //Update the bank account amount/balance
                $theUpdateModel = $this->model('User');
                
                //Saving into Recent Transaction(Chequing or Saving)
                $toTransaction = $this->model('User');

                //Accepting from a Chequing Account
                if(($theChequingBankAccount == true) && ($theSavingBankAccount == false))
                {
                    $theUpdateModel->amount = $theChequingBankAccount['Amount'] + $amountReceived;
                    $theUpdateModel->updateChequingAccountAmount($_POST['to_Option']);

                    $toTransaction->amount = $amountReceived;
                    $toTransaction->transaction_type = "E-Transfer from ".$_POST['username']."";
                    $toTransaction->user_chequing_id = $_POST['to_Option'];
                    $toTransaction->addChequingRecentTransaction();
                    header('location:/user/list_e_transfer_received');
                }

                //Accepting from a Saving Account
                else if(($theChequingBankAccount == false) && ($theSavingBankAccount == true))
                {
                    $theUpdateModel->amount = $theSavingBankAccount['Amount'] + $amountReceived;
                    $theUpdateModel->updateSavingAccountAmount($_POST['to_Option']);

                    $toTransaction->amount = $amountReceived;
                    $toTransaction->transaction_type = "E-Transfer from ".$_POST['username']."";
                    $toTransaction->user_saving_id = $_POST['to_Option'];
                    $toTransaction->addSavingRecentTransaction();
                    header('location:/user/list_e_transfer_received');
                }

                else
                {
                    $this->view('user/accept_e_transfer', ['e_transfer_data' =>$theETransferData,'chequing_account' => $theChequingAccount,'saving_account' => $theSavingAccount]);
                }
            }

            else
            {
                echo "Invalid Answer!";
            }
        }
    }

    public function refuse_e_transfer()
    {   
        $userModel = $this->model('User');
        $theETransferData = $userModel->getTheETransfer($_GET['Money_Transfer_id']);

        $this->view('user/refuse_e_transfer', ['e_transfer_data' =>$theETransferData]);

        if(isset($_POST['action']))
        {
            $updateETransfer = $this->model('User');
            $updateETransfer->status = "Refused";
            $updateETransfer->updateETransferStatus($_GET['Money_Transfer_id']);   
            header('location:/user/list_e_transfer_received');
        }
    }

     public function redeem_e_transfer()
    {   
        $userModel = $this->model('User');
        $theETransferData = $userModel->getTheETransfer($_GET['Money_Transfer_id']);
        $amountReceived = $userModel->getTheETransferInfo($_GET['Money_Transfer_id'])['Amount'];

        $theChequingAccount = $userModel->showAllUserChequingAccount($_SESSION['user_id']);
        $theSavingAccount = $userModel->showAllUserSavingAccount($_SESSION['user_id']);

        $this->view('user/redeem_refused_e_transfer', ['e_transfer_data' =>$theETransferData,'chequing_account' => $theChequingAccount,'saving_account' => $theSavingAccount]);

        //Update the bank account amount/balance
        $theUpdateModel = $this->model('User');
                
        //Saving into Recent Transaction(Chequing or Saving)
        $toTransaction = $this->model('User');

        if(isset($_POST['action']))
        {
            $updateETransfer = $this->model('User');
            $updateETransfer->status = "Refunded";
            $updateETransfer->updateETransferStatus($_GET['Money_Transfer_id']);   

            $theAccountModel = $this->model('User');
            $theChequingBankAccount = $theAccountModel->getTheTransferChequingAccount($_POST['to_Option']); 
            $theSavingBankAccount = $theAccountModel->getTheTransferSavingAccount($_POST['to_Option']); 

             //To Chequing Account
            if(($theChequingBankAccount == true) && ($theSavingBankAccount == false))
            {
                $theUpdateModel->amount = $theChequingBankAccount['Amount'] + $amountReceived;
                $theUpdateModel->updateChequingAccountAmount($_POST['to_Option']);

                $toTransaction->amount = $amountReceived;
                $toTransaction->transaction_type = "Refunded from E-Transfer";
                $toTransaction->user_chequing_id = $_POST['to_Option'];
                $toTransaction->addChequingRecentTransaction();
                header('location:/home/index');
            }

            //To Saving Account
            else if(($theChequingBankAccount == false) && ($theSavingBankAccount == true))
            {
                $theUpdateModel->amount = $theSavingBankAccount['Amount'] + $amountReceived;
                $theUpdateModel->updateSavingAccountAmount($_POST['to_Option']);

                $toTransaction->amount = $amountReceived;
                $toTransaction->transaction_type = "Refunded from E-Transfer";
                $toTransaction->user_saving_id = $_POST['to_Option'];
                $toTransaction->addSavingRecentTransaction();
                header('location:/home/index');
            }

            else
            {
                $this->view('user/accept_e_transfer', ['e_transfer_data' =>$theETransferData,'chequing_account' => $theChequingAccount,'saving_account' => $theSavingAccount]);
            }
        }
    }



    public function logout()
    {
        session_destroy();
        header('location:/home/login');
    }
}
?>