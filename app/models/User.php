<?php

/**
 * 
 */
class User{

	private $db;
	
	function __construct(){
		$this->db = new Database;
	}

	public function findUserByEmail($email){
		$this->db->prepare_statement("SELECT * FROM sharepost_users WHERE email = :email ");
		// bind ':email' to the $email variable
		$this->db->bind(':email', $email);
		return $this->db->fetch();
	}

	public function get_user_by_id($user_id){
		$this->db->prepare_statement("SELECT * FROM sharepost_users WHERE id = :user_id ");
		$this->db->bind(':user_id', $user_id);
		return $this->db->fetch();

	}

	// registers a user
	public function register($data){

		$this->db->prepare_statement("INSERT INTO sharepost_users(name,email,password)
		 VALUES(:name, :email, :password)");

		$this->db->bind(':name', $data['name']);
		$this->db->bind(':email', $data['email']);
		$this->db->bind(':password', $data['password']);

		return $this->db->execute();

	}


}