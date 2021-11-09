<?php
/**
 * Base controller to load the models and views
 */
class Controller{
	
	//loads model
	public function load_model($model){
		//require model file
		require_once '../app/models/' . $model . '.php';
		// instantiate the model
		return new $model();
	}

	// load view
	// we can use the array passed in, 
	// inside the view because the view would have access to it
	public function load_view($view, $data = []){

		// if the file exist require it which displays the file
		// otherwise whow error message 
		// letting the user know that this view does not exist
		if (file_exists('../app/views/' . $view . '.php')) {
			require_once '../app/views/' . $view . '.php';
		}else{
			die('View "' . $view . '" does not exist');
		}
		
	}
}