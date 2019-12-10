<?php


class Model
{
	protected $_connection;
	function __construct() //reserved name for constructor
	{
			/*
			$host = 'localhost';
			$dbname = 'bankdb';
			$user = 'root';
			$pass = '';
			*/

			$host = 'localhost';
			$dbname = 'bankdb';
			$user = 'root';
			$pass = 'eq8oqPwUBj6m1HyL';
		try
		{
			/**
			self::$_connection = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
			//this will build PDO object to access database
			*/
			$this->_connection = new PDO("mysql:host=$host; dbname=$dbname", $user, $pass);
		}

		catch(PDOException $e) 
		{
	 	   echo $e->getMessage();
		}
	}


}