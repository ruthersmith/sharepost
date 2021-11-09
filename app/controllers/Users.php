<?php
 /**
  * 
  */
 class Users extends Controller{
 	

 	function __construct(){

 		$this->userModel = $this->load_model("User");
 	}



 	 /**
  	  * Method to handle registration page
 	  */
 	public function register(){
 		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

 			// Sanitize the data, make sure that whatever is passed in are strings
 			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

  			$data = [
 				'name' => trim($_POST['name']),
 				'email' => trim($_POST['email']),
 				'password' => trim($_POST['password']),
 				'confirm_password' => trim($_POST['confirm_password']),
 				'name_error' => '',
 				'email_error' => '',
 				'password_error' => '',
 				'confirm_password_error' => '',
 			];	
 			// validate email 
 			if (empty($data['email'])) {
 				$data['email_error'] =  "Please fill out email field";
 			}elseif ($this->userModel->findUserByEmail($data['email'])) {
 				 $data['email_error'] =  "Email already exist";

 			}
 			
 			
 			// validate name 
 			$data['name_error'] = empty($data['name']) ? "Please fill out name field" : "";
 			// validate password 
 			if (empty($data['password'])) {
 				$data['password_error'] =  "Please fill out password field " ;
 			}elseif (strlen($data['password']) < 6) {
 				$data['password_error'] = "password need to be at least 6 characters";
 			}
 		 	// validate confirm password
 		 	if (empty($data['confirm_password']) ) {
 		 		$data['confirm_password_error'] ="Please fill out confirm password field";
 		 	}elseif ($data['confirm_password'] != $data['password']) {
 		 		$data['confirm_password_error'] = "Password does not mach";
 		 	}

 		 	// Make sure errors are empty
 		 	if (empty($data['email_error']) && 
 		 		empty($data['name_error']) && 
 		 		empty($data['password_error']) && 
 		 		empty($data['confirm_password_error'])) {

 		 		// Hash password
 		 		$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
 		 		// Register user
 		 		if($this->userModel->register($data)){
 		 			// session_helper function
 		 			flash('register_success', "You have successfully registered");
 		 			// url_helper function
 		 			redirect('users/login');
 		 		}else{
 		 			die("Something went horribly wrong :(");
 		 		}

 		 	}else{
 		 		$this->load_view('users/register', $data);
 		 	}

 		}else{
 			// Init Data
 			$data = [
 				'name' => '',
 				'email' => '',
 				'password' => '',
 				'confirm_password' => '',
 				'name_error' => '',
 				'email_error' => '',
 				'password_error' => '',
 				'confirm_password_error' => '',
 			];
 			//load view
 			$this->load_view('users/register', $data);
 		}
 	}

 	public function login(){
 		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

 			// Sanitize the data, make sure that whatever is passed in are strings
 			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

  			$data = [
 				'email' => trim($_POST['email']),
 				'password' => trim($_POST['password']),
 				'email_error' => '',
 				'password_error' => '',
 			];

 			// validate email 
 			$data['email_error'] = empty($data['email']) ? "Please fill out email field" : "";
 			// validate confirm password
 		 	if (empty($data['password']) ) {
 		 		$data['password_error'] ="Please fill out password field";
 		 	}

 		 	// Make sure errors are empty, 
 		 	// if it is empty try to authenticate the user
 		 	// else  reload login form so that user can fix their mistake
 		 	if (empty($data['email_error']) && 
 		 		empty($data['password_error'])) {

 		 		$user = $this->userModel->findUserByEmail($data['email']);
 		 		// if we find the user by their email, try to 
				if (!$user) {
					$data['email_error'] = "No User Found!!";
					$this->load_view('users/login', $data);
				}else{
					// verify_password is a php function that Verifies
					// that the given hash matches the given password.
					// Note that password_hash() returns the algorithm, cost and salt as part of 
					// the returned hash. Therefore, all information that's needed to verify the hash
					// is included in it. This allows the verify function to verify the hash without
					// needing separate storage for the salt or algorithm information.
					// data contains the form data passed in by the user tring to logon in
					// user contains the user with the matching email address
					if (password_verify($data['password'], $user->password)) {
						$this->createUserSession($user);
						redirect('posts/index');	
					}else{
						$data['password_error'] = "Incorrect email and password combination";
						$this->load_view('users/login', $data);

					}
				}
 		 		
 		 	}else{
 		 		$this->load_view('users/login', $data);
 		 	}

 		}else{
 			// Init Data
 			$data = [
 				'email' => '',
 				'password' => '',
 				'email_error' => '',
 				'password_error' => '',
 			];
 			//load view
 			$this->load_view('users/login', $data);
 		}
 	}

 	public function logout(){
 		unset($_SESSION['user']);
 		session_destroy();
 		redirect('users/login');
 	}

 	private function createUserSession($user){
 		unset($user->password);
 		$_SESSION['user'] = $user;
 	}
 }

