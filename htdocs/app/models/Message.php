<?php

class Message extends Model
{
	//Message
	public $msgId;
	public $title;
	public $msg;
	public $msg_read;
	public $time_created;
	public $senderId;
	public $receiverId;


	public function createMessage()
	{
		
		//timezone
		date_default_timezone_set("America/Toronto");
	
		$this->time_created = date("Y-m-d h:i:s");

		$stmt = $this->_connection->prepare("INSERT INTO message ( Title, Message, Message_Read, Time_Created, Sender_id, Receiver_id) VALUES (?, ?, ?, ?, ?, ?); ");

		$stmt->execute([$this->title,$this->msg, $this->msg_read,$this->time_created,$this->senderId,$this->receiverId]);

		return $stmt->rowCount();
	}

	public function ReceivedMessages($receiver)
	{
		$receiverId = $receiver;

		$stmt = $this->_connection->prepare("SELECT * FROM MESSAGE WHERE Receiver_id = :Receiver_id ORDER BY Time_Created");
		$stmt->execute(['Receiver_id' => $receiverId]);

		
		return  $stmt->fetchAll(); 
	}

	public function SentMessages($sender){
		$senderId = $sender;
		//("SELECT * FROM Message WHERE Sender_id = :senderId");
		$stmt = $this->_connection->prepare("SELECT * FROM MESSAGE WHERE Sender_id = :Sender_id ORDER BY Time_Created");
		$stmt->execute(['Sender_id'=>$senderId]);

		
		return $stmt->fetchAll(); 
	}

	public function getMessage($msgId){
		//SELECT * FROM Message WHERE message_id = :message_id
		$stmt = $this->_connection->prepare("SELECT * FROM Message WHERE message_id = :message_id");
		$stmt->execute(['message_id'=>$msgId]);
		$stmt->setFetchMode(PDO::FETCH_CLASS,'Message');
		return $stmt->fetch();

	}

	public function updateMessage($msgId)
	{
		$this->msg_read = 1;
		$stmt = $this->_connection->prepare("UPDATE Message SET Message_Read = :Message_Read");
		$stmt->execute(['Message_Read'=>$this->msg_read]);

		return $stmt->rowCount();
	}

	 public function deleteMessage($msgId){
        $stmt = $this->_connection->prepare("DELETE FROM Message WHERE message_id = :message_id");
        $stmt->execute(['message_id'=>$msgId]);
    }
	

}

?>