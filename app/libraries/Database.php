<?php
	/*
	 * Database class, uses PDO (PHP Data Objects)
	 * Connects to the Databse, and perform crud operation
	 */

/**
 * 
 */
class Database{

	
	private $host = DB_HOST;
	private $user = DB_USER;
	private $pass = DB_PASS;
	private $db_name = DB_NAME;
	private $rdbms = DB_RDBMS;

	// whenever we prepare a statement we are going to use this database handler
	private $database_handler;
	private $error;
	private $statement;

	function __construct($foo = null){
		//dsn = database_source_name
		$dsn = "{$this->rdbms}:host={$this->host};dbname={$this->db_name}";

		$options = array(
			PDO::ATTR_PERSISTENT =>  true,
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		);
		// create a new pdo instance
		try {
			$this->database_handler = new PDO($dsn,$this->user, $this->pass,$options);	
		} catch (PDOException $e) {
			$this->error = $e->getMessage();
			echo $this->error;
		}
	}

	public function prepare_statement($query){
		$this->statement = $this->database_handler->prepare($query);
	}

	public function bind($param, $value, $type=null){
		if (is_null($type)) {
			if (is_int($value)) {
				$type = PDO::PARAM_INT;
			}elseif (is_bool($value)) {
				$type = PDO::PARAM_BOOL;
			}elseif (is_null($value)) {
				$type = PDO::PARAM_NULL;
			}else{
				$type = PDO::PARAM_STR;				
			}
		}
		$this->statement->bindValue($param, $value, $type);
	}

	public function execute(){
		return $this->statement->execute();
	}

	// get record as array of objects
	public function fetchall(){
		$this->execute();
		return $this->statement->fetchall(PDO::FETCH_OBJ);
	}

	// get single record
	public function fetch(){
		$this->execute();
		return $this->statement->fetch(PDO::FETCH_OBJ);
	}

	public function row_count(){
		return $this->statement->rowCount() ;
	}
}