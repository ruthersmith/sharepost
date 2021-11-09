<?php

/**
 * 
 */
class Post  {
	
	private $db;
	
	function __construct(){
		$this->db = new Database;
	}

	public function get_posts(){
		$sql = "SELECT user_id, sharepost_posts.id as post_id, title, body, 
				sharepost_posts.created_at, name, email 
				FROM `sharepost_posts` 
				JOIN sharepost_users on sharepost_users.id = sharepost_posts.user_id
				ORDER BY sharepost_posts.created_at DESC";
		$this->db->prepare_statement($sql);
		return $this->db->fetchall();
	}

	// get a single post by id
	public function get_post_by_id($post_id){
		$sql = "SELECT *
				FROM `sharepost_posts` 
				WHERE id = :post_id";

		$this->db->prepare_statement($sql);
		$this->db->bind(':post_id', $post_id);
		return $this->db->fetch();
	}


	public function add_post($data){
		$this->db->prepare_statement("INSERT INTO sharepost_posts(user_id,title,body)
		 VALUES(:user_id, :title, :body)");

		$this->db->bind(':user_id', $data['user_id']);
		$this->db->bind(':title', $data['title']);
		$this->db->bind(':body', $data['body']);

		return $this->db->execute();

	}

	public function update_post($data){
		$this->db->prepare_statement("UPDATE sharepost_posts 
			SET title = :title, body = :body 
			WHERE id = :post_id");

		$this->db->bind(':post_id', $data['post_id']);
		$this->db->bind(':title', $data['title']);
		$this->db->bind(':body', $data['body']);

		return $this->db->execute() ;
	}

	public function delete_post($post_id){
		$this->db->prepare_statement("DELETE FROM sharepost_posts WHERE id = :post_id");
		$this->db->bind(':post_id', $post_id);
		return $this->db->execute() ;
	}
}