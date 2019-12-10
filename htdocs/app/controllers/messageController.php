<?php

class MessageController extends Controller
{
    
    public function index()
    {
        if(!$_SESSION){
        //session_destroy();
        $this->view('user/welcome');  
        }  
    }

    public function create()
    {

        $this->view('message/create');
        
        if(isset($_POST['send']))
        {
            //$receiver_user = $_POST['receiver'];
           $theReceiverUser = $this->model('User')->getUser($_POST['receiver']);
           
          
            //If the recipient is found!
            if($theReceiverUser != null)
            {
                $receiver = $theReceiverUser->getUserId($_POST['receiver']);

                $newMsg = $this->model('Message');
                $newMsg->senderId = $_SESSION['user_id'];
                $newMsg->receiverId = $receiver;
                $newMsg->title = $_POST['title'];
                $newMsg->msg = $_POST['message']; 
                $newMsg->msg_read = 0;                               

                $newMsg->createMessage();

                header('location:/message/listMessages');

            }

            else
            {
               $receiver = $theReceiverUser->getUserId($_POST['receiver']);
                $newMsg = $this->model('Message');
                $newMsg->senderId = $_SESSION['user_id'];
                $newMsg->receiverId = $receiver;
                $newMsg->title = "Message Undelivered";
                $newMsg->msg = "The username ".$_POST['receiver']. "has not been found.";
                $newMsg->msg_read = 0; 

                $newMsg->createMessage();         

                header('location:/message/listMessages');   
            }
        }
    }

    public function listMessages()
    {
        if(isset($_SESSION['user_id']))
        {
            $messages = $this->model('Message');
            $user = $this->model('User');

            $userReceiver = $_SESSION['user_id'];
            $inbox = $messages->ReceivedMessages($userReceiver);
            
            

            $this->view('message/inbox', ['theMessage' => $inbox,'user'=> $user]);
        }else{

            echo '<script language="javascript">';
                    echo 'alert("No messages")';
                    echo '</script>';
        }
    
    }

    public function sentMessages()
    {
        if(isset($_SESSION['user_id']))
        {
            //$username = $this->model('User');
            $messages = $this->model('Message');

            $user = $this->model('User');
            $userId = $_SESSION['user_id'];

            $sentMsg = $messages->SentMessages($userId);

            //var_dump($UserReceiver["user_id"]);

            $this->view('message/sent',['sentMessage'=>$sentMsg, 'user' =>$user]);
        }else{
             header('location:/user/login');
        }
    }

    public function viewReceivedMessage()
    {
       
        if(isset($_SESSION['user_id']))
        {
               
                $message = $this->model('Message')->getMessage($_GET['Message_id']);
                
                $user = $this->model('User');
                $receiver = $user->getUserFromId($message->Receiver_id);
                $sender = $user->getUserFromId($message->Sender_id);
                
                    $message->updateMessage($_GET['Message_id']);

                $this->view('message/details',['theMessage' => $message, 'sender' => $sender, 'receiver' => $receiver]);
            }else{

                header('location:/user/login');

            }             
    }


    public function viewSentMessage()
    {
       
        if(isset($_SESSION['user_id']))
        {
               
                $message = $this->model('Message')->getMessage($_GET['Message_id']);
                
                $user = $this->model('User');
                $receiver = $user->getUserFromId($message->Receiver_id);
                $sender = $user->getUserFromId($message->Sender_id);
                

                $this->view('message/details',['theMessage' => $message, 'sender' => $sender, 'receiver' => $receiver]);
            }else{

                
            header('location:/user/login');
            }             
    }

    public function deleteMail()
    {
        $msg_id = $_GET['Message_id'];
        $message = $this->model('Message')->getMessage($msg_id);
        $user = $this->model('User');
       
        $receiver = $user->getUserFromId($message->Receiver_id);
        $sender = $user->getUserFromId($message->Sender_id);
        
        if(!isset($_POST['action'])){
            $this->view('message/delete', ['msg'=> $message, 'receiver' => $receiver, 'sender' => $sender]);  
        }else{
            $message->deleteMessage($msg_id);
            //redirecttoaction
            header('location:/message/listMessages');
        }
    }

     public function logout()
    {
        session_destroy();
        header('location:/user/login');
    }


}
?>