<?php 
class db{
    private $servername = "localhost";
	private $username = "root";
	private $password = "";
	private $dbname = "pccm";

	public $mysql;
	function __construct() {
	$this->mysql = new mysqli($this->servername,$this->username,$this->password,$this->dbname);

	$this->mysql->set_charset('utf8');
	
	if($this->mysql->connect_error) {
	die("Connection Failed : " . $this->mysql->connect_error);
}
}




}

 ?>
