<?php


	class Database
	{
			public $dbConnection;

			public function __construct(){
				$this->dbConnection = mysqli_connect('localhost', 'root', '', 'tester');
				if(!$this->dbConnection){
					echo mysqli_connect_error();
				} else {
					//echo "Succefull Connected";
				}
			}
	}

	//$objects = new Database;

 ?>
