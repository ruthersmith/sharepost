<?php

/**
 * 
 */
class Posts extends Controller{
	
	function __construct(){
		if (!is_logged_in()) {
			redirect('users/login');
		}
		$this->post_model = $this->load_model('Post');
		$this->userModel = $this->load_model("User");

	}

	public function index(){
		$data['posts'] = $this->post_model->get_posts();
		$this->load_view('posts/index', $data);
	}

	public function add(){

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			// Sanitize post array
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			$data = [
			'title' => trim($_POST['title']),
			'body' => trim($_POST['body']),
			'user_id' => $_SESSION['user']->id,
			'title_error' => '',
			'body_error' => ''
			];

			$data['title_error'] = empty($data['title']) ? "Please enter a Title" : '';
			$data['body_error'] = empty($data['body']) ? "Please enter a Body" : '';

			if (empty($data['body_error']) && empty($data['title_error']) ) {
				// if they are both empty there are no errors
				if ($this->post_model->add_post($data)) {
					flash('post-message', 'Post added');
					redirect('posts');
				}else{
					die('something went wrong');
				}
			}else{
				$this->load_view('posts/add', $data);		
			}

		
			
		}else{

			$data = [
			'title' => '',
			'body' => '',
			'title_error' => '',
			'body_error' => ''
			];
				
			$this->load_view('posts/add', $data);		
		}	
	}

	public function show($post_id){
		$data['post'] = $this->post_model->get_post_by_id($post_id);
		$data['author'] = $this->userModel->get_user_by_id($data['post']->user_id);

		$this->load_view('posts/show', $data);

	}

	public function edit($post_id){
		$data['post'] = $this->post_model->get_post_by_id($post_id);
		// if the logged in user is not the author of the post, redirect because they cannot edit it
		if ($_SESSION['user']->id != $data['post']->user_id) { 
			redirect('posts');
		}

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			// Sanitize post array
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			$data = [
			'post_id' => $post_id,
			'title' => trim($_POST['title']),
			'body' => trim($_POST['body']),
			'title_error' => '',
			'body_error' => ''
		 	];



			$data['title_error'] = empty($data['title']) ? "Please enter a Title" : '';
			$data['body_error'] = empty($data['body']) ? "Please enter a Body" : '';

			if (empty($data['body_error']) && empty($data['title_error']) ) {
				// if they are both empty there are no errors
				if ($this->post_model->update_post($data)) {
					flash('post-message', 'Post Updated');
					redirect('posts');
				}else{
					die('something went wrong');
				}
			}else{
				$this->load_view('posts/edit', $data);		
			}

		}else{
			$data = [
			'post_id' => $post_id,
			'title' => $data['post']->title,
			'body' => $data['post']->body,
			'title_error' => '',
			'body_error' => ''
		];
		$this->load_view('posts/edit', $data);
		}
				
	}

	public function delete($post_id){
		$data['post'] = $this->post_model->get_post_by_id($post_id);
		// if the logged in user is not the author of the post, redirect because they cannot edit it
		if ($_SESSION['user']->id != $data['post']->user_id) { 
			redirect('posts');
		}
		
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			
			if ($this->post_model->delete_post($post_id)) {
				flash('post-message', 'Post removed');
				redirect('posts');
			}else{
				die('something went wrong');
			}

		}else{
			redirect("posts");
		}
	}


}