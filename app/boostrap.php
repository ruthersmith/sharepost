<?php

// load config files
require_once 'config/config.php';

//load helpers
require_once 'helpers/url_helper.php';
require_once 'helpers/session_helper.php';


//load libraries
// require_once 'libraries/core.php';
// require_once 'libraries/controller.php';
// require_once 'libraries/database.php';

//auto load core libraries
spl_autoload_register(function($className){
	require_once 'libraries/' . $className . '.php';
});