<?php
//  PHP built in function ::  starts new or resume existing session
session_start();

// Flash message helper
// To Set a flash message call flash($name, $message), optionally you add a class param
// To display a flash message, call flash($name) with only the name as the parameter
// Note the flash message can only be shown once, it will be unset after display
// Nothing will happen if the flash message is not set
function flash($name, $message='', $class = 'alert alert-success'){
	// if the message is not empty, we are trying to set the message in the session
	// else we are trying to display it
	if (!empty($message)) {
		$_SESSION[$name] = $message;
		$_SESSION[$name . "_class"] = $class;
	}else{
		// only display if we are trying to flash and flash exist
		if (isset($_SESSION[$name] ) ) {
			echo "<div class='{$_SESSION[$name . "_class"]}'>{$_SESSION[$name]}</div>";
			unset($_SESSION[$name]);
			unset($_SESSION[$name . "_class"]);
		}
	
	}
}

function is_logged_in(){
	return isset($_SESSION['user']);
}