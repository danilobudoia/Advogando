<?php
	Class Connection
	{
		private $dsn = "mysql:dbname=advogando;host=127.0.0.1";	
		private $dbuser = "root";
		private $dbpass = "";
		private $db;
				
		function __construct(){
			$this->db = new PDO($this->dsn,$this->dbuser,$this->dbpass);
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$this->db->exec("SET CHARACTER SET utf8");
		}
		
		public function getDb(){
			return $this->db;
		}			
	}	
?>